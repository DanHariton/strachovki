<?php


namespace App\Service;


use OpenPayU_Configuration;
use Symfony\Bundle\FrameworkBundle\Controller\ControllerTrait;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class OrderFactory
{
    public function __construct()
    {
        //set Sandbox Environment
        OpenPayU_Configuration::setEnvironment('sandbox');

        //set POS ID and Second MD5 Key (from merchant admin panel)
        OpenPayU_Configuration::setMerchantPosId('393916');
        OpenPayU_Configuration::setSignatureKey('b11ff54f1105e3729e13d37eee110556');

        //set Oauth Client Id and Oauth Client Secret (from merchant admin panel)
        OpenPayU_Configuration::setOauthClientId('393916');
        OpenPayU_Configuration::setOauthClientSecret('09f9aa005df78b2e377ba2bd7c329ae6');
    }

    public function createOrder($insurance, $successPaymentUrl, $callbackUrl)
    {
        $order['continueUrl'] = $successPaymentUrl;
        $order['notifyUrl'] = $callbackUrl;
        $order['customerIp'] = $_SERVER['REMOTE_ADDR'];
        $order['merchantPosId'] = OpenPayU_Configuration::getMerchantPosId();
        $order['description'] = 'New order';
        $order['currencyCode'] = 'PLN';
        $order['totalAmount'] = $insurance->getPrice() * 100;

        $order['products'][0]['name'] = $insurance->getInsuranceName();
        $order['products'][0]['unitPrice'] = $insurance->getPrice() * 100;
        $order['products'][0]['quantity'] = 1;

        //optional section buyer
        $order['buyer']['email'] = $insurance->getClientEmail();
        $order['buyer']['phone'] = $insurance->getClientMobile();
        $order['buyer']['firstName'] = $insurance->getClientName();
        $order['buyer']['lastName'] = $insurance->getClientSName();

        return $order;
    }
}