<?php


namespace App\Service;


use App\Entity\Insurance;
use OpenPayU_Configuration;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class OrderFactory
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;

        //set Sandbox Environment
        OpenPayU_Configuration::setEnvironment('secure');

        //set POS ID and Second MD5 Key (from merchant admin panel)
        OpenPayU_Configuration::setMerchantPosId($this->params->get('payu_pos_id'));
        OpenPayU_Configuration::setSignatureKey($this->params->get('payu_second_key'));

        //set Oauth Client Id and Oauth Client Secret (from merchant admin panel)
        OpenPayU_Configuration::setOauthClientId($this->params->get('payu_auth_id'));
        OpenPayU_Configuration::setOauthClientSecret($this->params->get('payu_auth_password'));
    }

    /**
     * @param Insurance $insurance
     * @param $successPaymentUrl
     * @param $callbackUrl
     * @return mixed
     */
    public function createOrder(Insurance $insurance, $successPaymentUrl, $callbackUrl)
    {
        $order['continueUrl'] = $successPaymentUrl;
        $order['notifyUrl'] = $callbackUrl;
        $order['customerIp'] = $_SERVER['REMOTE_ADDR'];
        $order['merchantPosId'] = OpenPayU_Configuration::getMerchantPosId();
        $order['description'] = 'New order';
        $order['currencyCode'] = 'CZK';
        $order['totalAmount'] = $insurance->getPrice() * 100;

        $order['products'][0]['name'] = $insurance->getInsuranceName();
        $order['products'][0]['unitPrice'] = $insurance->getPrice() * 100;
        $order['products'][0]['quantity'] = 1;

        //optional section buyer
        $order['buyer']['email'] = $insurance->getClientEmail();
        $order['buyer']['phone'] = $insurance->getClientMobile();
        $order['buyer']['firstName'] = $insurance->getClientName();
        $order['buyer']['lastName'] = $insurance->getClientSName();
        $order['buyer']['language'] = 'cs';

        return $order;
    }
}