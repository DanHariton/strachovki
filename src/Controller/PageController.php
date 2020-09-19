<?php

namespace App\Controller;

use App\Entity\ClientsPhones;
use App\Entity\Insurance;
use App\Entity\InsurancePrice;
use App\Form\ClientPhoneType;
use App\Form\InsurancePaymentByPasswordType;
use App\Form\InsuranceType;
use App\Service\OrderFactory;
use App\Util\FakeTranslator;
use Doctrine\ORM\EntityManagerInterface;
use OpenPayU_Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/insurance-for-foreigners", name="page_insurance_options")
     */
    public function insuranceOptionsAction()
    {
        return $this->render('page/action/insurance_options.html.twig');
    }


    /**
     * @Route("/apply/{name}", name="page_apply_insurance", requirements={"name"="ergo|uniqa|pvzp|maxima"})
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \OpenPayU_Exception
     */
    public function applyInsuranceAction($name, Request $request, EntityManagerInterface $em, OrderFactory $orderFactory, \Swift_Mailer $mailer)
    {
        $insurance = new Insurance();
        $insurance->setInsuranceName($name);
        $insurancePrice = $em->getRepository(InsurancePrice::class)->findOneByName($name);

        $form = $this->createForm(InsuranceType::class, $insurance)
         ->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Insurance $insurance */
            $insurance = $form->getData();
            $insurance->recalculatePrice($insurancePrice);
            $insurance->setPaymentPassword(base64_encode(date('d.m.Y h:i:s')));

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
            'insurancePrice' => $insurancePrice ? base64_encode(json_encode($insurancePrice->toArray())) : ''
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
     * @param \Swift_Mailer $mailer
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function paymentCallbackAction(Request $request, EntityManagerInterface $em, \Swift_Mailer $mailer)
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
}