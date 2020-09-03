<?php

namespace App\Controller;

use App\Entity\ClientsPhones;
use App\Entity\Insurance;
use App\Entity\InsurancePrice;
use App\Form\ClientPhoneType;
use App\Form\InsuranceType;
use App\Util\FakeTranslator;
use Doctrine\ORM\EntityManagerInterface;
use OpenPayU_Configuration;
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
    public function applyInsuranceAction($name, Request $request, EntityManagerInterface $em)
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

            //set Sandbox Environment
            OpenPayU_Configuration::setEnvironment('sandbox');

            //set POS ID and Second MD5 Key (from merchant admin panel)
            OpenPayU_Configuration::setMerchantPosId('393916');
            OpenPayU_Configuration::setSignatureKey('b11ff54f1105e3729e13d37eee110556');

            //set Oauth Client Id and Oauth Client Secret (from merchant admin panel)
            OpenPayU_Configuration::setOauthClientId('393916');
            OpenPayU_Configuration::setOauthClientSecret('09f9aa005df78b2e377ba2bd7c329ae6');

            $order['continueUrl'] = $this->generateUrl('page_success_payment', [], UrlGeneratorInterface::ABSOLUTE_URL);
            $order['notifyUrl'] = $this->generateUrl('page_payment_callback', [], UrlGeneratorInterface::ABSOLUTE_URL);
            $order['customerIp'] = $_SERVER['REMOTE_ADDR'];
            $order['merchantPosId'] = OpenPayU_Configuration::getMerchantPosId();
            $order['description'] = 'New order';
            $order['currencyCode'] = 'PLN';
            $order['totalAmount'] = $insurance->getPrice() * 100;

            $order['products'][0]['name'] = $name;
            $order['products'][0]['unitPrice'] = $insurance->getPrice() * 100;
            $order['products'][0]['quantity'] = 1;

            //optional section buyer
            $order['buyer']['email'] = $insurance->getClientEmail();
            $order['buyer']['phone'] = $insurance->getClientMobile();
            $order['buyer']['firstName'] = $insurance->getClientName();
            $order['buyer']['lastName'] = $insurance->getClientSName();

            $response = OpenPayU_Order::create($order);
            $responseData = $response->getResponse();
            $insurance->setPaymentId($responseData->orderId);
            $em->persist($insurance);
            $em->flush();

            return $this->redirect($responseData->redirectUri);
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
     * @Route("/payu/paymnet-callback", name="page_payment_callback")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function paymentCallbackAction(Request $request, EntityManagerInterface $em)
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
            // TODO: send email
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
}