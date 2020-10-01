<?php

namespace App\Controller;

use App\Entity\ClientsPhones;
use App\Entity\Insurance;
use App\Entity\InsurancePrice;
use App\Form\ClientPhoneType;
use App\Form\InsurancePaymentByPasswordType;
use App\Form\InsuranceType;
use App\Service\InsurancePriceFactory;
use App\Service\OrderFactory;
use App\Util\FakeTranslator;
use Doctrine\ORM\EntityManagerInterface;
use OpenPayU_Order;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="page_index")
     */
    public function indexAction(EntityManagerInterface $em)
    {
        $clientPhones = new ClientsPhones();
        $form = $this->createForm(ClientPhoneType::class, $clientPhones);

        if ($form->isSubmitted() && $form->isValid()) {
            $clientPhones = $form->getData();
            $em->persist($clientPhones);
            $em->flush();

            $this->addFlash('success', (new FakeTranslator())->trans('page.applyClientPhone.flash.success'));
            return $this->redirectToRoute('page_index');
        }

        return $this->render('page/action/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/insuarence-maxima-options", name="page_insurance_maxima_options")
     */
    public function insuranceMaximaOptions()
    {
        return $this->render('page/action/insurance_maxima_options.html.twig');
    }

    /**
     * @Route ("/insuarence-uniqa-options", name="page_insurance_uniqa_options")
     */
    public function insuranceUniqaOptions()
    {
        return $this->render('page/action/insurance_uniqa_options.html.twig');
    }

    /**
     * @Route ("/insuarence-ergo-options", name="page_insurance_ergo_options")
     */
    public function insuranceErgoOptions()
    {
        return $this->render('page/action/insurance_ergo_options.html.twig');
    }

    /**
     * @Route ("/insuarence-pvzp-options", name="page_insurance_pvzp_options")
     */
    public function insurancePVZPOptions()
    {
        return $this->render('page/action/insurance_pvzp_options.html.twig');
    }

    /**
     * @Route("/insurance-for-foreigners", name="page_insurance_options")
     */
    public function insuranceOptionsAction()
    {
        return $this->render('page/action/insurance_options.html.twig');
    }


    /**
     * @Route("/apply/{name}/{type}", name="page_apply_insurance", requirements={"name"="ergo|uniqa|pvzp|maxima", "type"="complex|urgent"})
     * @param $name
     * @param $type
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param OrderFactory $orderFactory
     * @param Swift_Mailer $mailer
     * @param InsurancePriceFactory $insurancePriceFactory
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \OpenPayU_Exception
     */
    public function applyInsuranceAction($name, $type, Request $request, EntityManagerInterface $em, OrderFactory $orderFactory,
                                         Swift_Mailer $mailer, InsurancePriceFactory $insurancePriceFactory)
    {
        $insurance = new Insurance();
        $insurance->setInsuranceName($name);
        $insurance->setInsuranceType($type);
        $insurancePrices = $em->getRepository(InsurancePrice::class)->findByName($name);

        if (!empty($insurancePrices)) {
            $insurancePriceList = [];
            for ($i = 0; $i < count($insurancePrices); $i++) {
                $insurancePriceList[$i] = $insurancePrices[$i]->toArray();
            }
        } else {
            $insurancePriceList = null;
        }

        $form = $this->createForm(InsuranceType::class, $insurance, array('insuranceType' => $type))
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Insurance $insurance */
            $insurance = $form->getData();
            $insurance->setPrice($insurancePriceFactory->calculatePriceByAge($insurance));
            $insurance->setPaymentPassword(base64_encode(date('d.m.Y h:i:s')));
            $insurance->setPaidToInsuranceCompany(false);
            $insurance->setSentToClient(false);

            $message = (new \Swift_Message('Новый заказ'))
                ->setFrom('danilhariton@gmail.com')
                ->setTo($insurance->getClientEmail())
                ->setBody(
                    $this->renderView(
                        'emails/confirm_order.html.twig',
                        ['insurance' => $insurance]
                    ),
                    'text/html'
                )
            ;

            $mailer->send($message);

            if ($insurance->getPaymentMethod() == Insurance::PAYMENT_METHOD_ONLINE) {
                $response = OpenPayU_Order::create($orderFactory->createOrder($insurance,
                    $this->generateUrl('page_success_payment', [], UrlGeneratorInterface::ABSOLUTE_URL),
                    $this->generateUrl('page_payment_callback', [], UrlGeneratorInterface::ABSOLUTE_URL)));

                $responseData = $response->getResponse();
                $insurance->setPaymentId($responseData->orderId);
                $em->persist($insurance);
                $em->flush();

                return $this->redirect($responseData->redirectUri);
            } else {
                $em->persist($insurance);
                $em->flush();

                return $this->redirectToRoute('page_confirmation_order');
            }
        }

        return $this->render('page/action/apply_insurance.html.twig', [
            'form' => $form->createView(),
            'name' => $name,
            'type' => $type,
            'insurancePrice' => $insurancePriceList ? base64_encode(json_encode($insurancePriceList)) : ''
        ]);
    }

    /**
     * @Route("/success-payment", name="page_success_payment")
     * @return Response
     */
    public function successPaymentAction()
    {
        return $this->render('page/action/success_payment.html.twig');
    }

    /**
     * @Route("/confirmation-order", name="page_confirmation_order")
     * @return Response
     */
    public function confirmationOrderAction()
    {
        return $this->render('page/action/confirmation_order.html.twig');
    }

    /**
     * @Route("/payu/paymnet-callback", name="page_payment_callback")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Swift_Mailer $mailer
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function paymentCallbackAction(Request $request, EntityManagerInterface $em, Swift_Mailer $mailer)
    {
        $responseData = json_decode($request->getContent());
        $insurance = $em
            ->getRepository(Insurance::class)
            ->findOneByPaymentId($responseData->order->orderId);

        if (!$insurance) {
            throw $this->createNotFoundException();
        }

        if ($responseData->order->status === 'COMPLETED') {
            $insurance->setStatus(Insurance::STATUS_PAYED_SUCCESS);

            $message = (new \Swift_Message('Спасибо за оплату!'))
                ->setFrom('danilhariton@gmail.com')
                ->setTo($insurance->getClientEmail())
                ->setBody(
                    $this->renderView(
                        'emails/payment_success.html.twig',
                        ['insurance' => $insurance]
                    ),
                    'text/html'
                )
            ;

            $mailer->send($message);

            $em->flush();
            return new Response();
        }
        if ($responseData->order->status === 'CANCELED') {
            $insurance->setStatus(Insurance::STATUS_PAYED_ERROR);
            $em->flush();
            return new Response();
        }

        return new Response('', Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @Route("/pay-online", name="page_pay_online")
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \OpenPayU_Exception
     */
    public function paymentOnlineAction(Request $request, EntityManagerInterface $em, OrderFactory $orderFactory)
    {
        $insurance = new Insurance();
        $form = $this->createForm(InsurancePaymentByPasswordType::class, $insurance)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $insurance = $form->getData();
            $insurance = $em->getRepository(Insurance::class)->findOneByPaymentPassword($insurance->getPaymentPassword());

            if ($insurance == null)
            {
                return $this->redirectToRoute('page_order_not_found');
            }
            if ($insurance->getStatus() == Insurance::STATUS_PAYED_SUCCESS)
            {
                return $this->redirectToRoute('page_success_payment');
            }

            $response = OpenPayU_Order::create($orderFactory->createOrder($insurance,
                $this->generateUrl('page_success_payment', [], UrlGeneratorInterface::ABSOLUTE_URL),
                $this->generateUrl('page_payment_callback', [], UrlGeneratorInterface::ABSOLUTE_URL)));

            $responseData = $response->getResponse();
            $insurance->setPaymentId($responseData->orderId);

            $em->persist($insurance);
            $em->flush();

            return $this->redirect($responseData->redirectUri);
        }

        return $this->render('page/action/pay_online.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/order-not-found", name="page_order_not_found")
     * @return Response
     */
    public function orderNotFoundAction()
    {
        return $this->render('page/action/order_not_found.html.twig');
    }

    /**
     * @Route("/contact", name="page_contact")
     */
    public function contactAction()
    {
        return $this->render('page/action/contact.html.twig');
    }

    /**
     * @Route("/our-license", name="page_our_license")
     */
    public function ourLicenseAction()
    {
        return $this->render('page/action/our_license.html.twig');
    }

    /**
     * @Route("/our-license/certifacate", name="page_license_certificate")
     */
    public function certificateAction()
    {
        $file = new File(__DIR__ . '/../../templates/src/page/pdf/certifikat.pdf');

        return $this->file($file, 'certifikat.pdf', ResponseHeaderBag::DISPOSITION_INLINE);
    }

    /**
     * @Route("/our-license/osvedceni", name="page_license_osvedceni")
     */
    public function osvedceniAction()
    {
        $file = new File(__DIR__ . '/../../templates/src/page/pdf/osvedceni.pdf');

        return $this->file($file, 'osvedceni.pdf', ResponseHeaderBag::DISPOSITION_INLINE);
    }
}