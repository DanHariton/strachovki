<?php

namespace App\Service;

use App\Entity\BankReference;
use App\Entity\ClientsPhones;
use App\Entity\Insurance;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class EmailSender
{
    /** @var MailerInterface */
    private $mailer;

    /** @var ParameterBagInterface */
    private $bag;

    /** @var UrlGeneratorInterface */
    private $generator;

    /** @var ContainerInterface */
    private $templating;

    public function __construct(MailerInterface $mailer, ParameterBagInterface $bag,
                                UrlGeneratorInterface $generator, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->bag = $bag;
        $this->generator = $generator;
        $this->templating = $twig;
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    private function send($to, $subject, $html)
    {
        $email = (new Email())
            ->from($this->bag->get('mailer.from.email'))
            ->to($to)
            ->subject($subject)
            ->html($html);

        $this->mailer->send($email);
    }

    /**
     * @param Insurance $insurance
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function sendConfirmInsuranceOrder(Insurance $insurance)
    {
        $this->send($insurance->getClientEmail(), 'Подтверждение заказа на zastrachuj.cz', $this->templating->render(
            'emails/confirm_order.html.twig',
            ['insurance' => $insurance, 'type' => $insurance->getInsuranceType()]
        ));
    }

    /**
     * @param Insurance $insurance
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function sendConfirmPayment(Insurance $insurance)
    {
        $this->send($insurance->getClientEmail(), 'Спасибо за оплату!', $this->templating->render(
            'emails/payment_success.html.twig',
            ['insurance' => $insurance]
        ));
    }

    /**
     * @param BankReference $bankReference
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function sendConfirmBankReferenceOrder(BankReference $bankReference)
    {
        $this->send($bankReference->getEmail(), 'Подтверждение заказа на zastrachuj.cz', $this->templating->render(
            'emails/confirm_bank_reference.html.twig'
        ));
    }

    /**
     * @param Insurance $insurance
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function sendNotifyToMeInsurance(Insurance $insurance)
    {
        $this->send($this->bag->get('email.kota'), 'Уведомление о новом заказе страховки', $this->templating->render(
            'emails/notify_insurance.html.twig',
            ['insurance' => $insurance, 'type' => $insurance->getInsuranceType()]
        ));
    }

    /**
     * @param BankReference $bankReference
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function sendNotifyToMeBankReference(BankReference $bankReference)
    {
        $this->send($this->bag->get('email.kota'), 'Уведомление о новой заявке на справку из банка', $this->templating->render(
            'emails/notify_reference.html.twig',
            ['reference' => $bankReference]
        ));
    }

    /**
     * @param ClientsPhones $clientsPhones
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function sendNotifyQuestion(ClientsPhones $clientsPhones)
    {
        $this->send($this->bag->get('email.kota'), 'Вопрос от клиента', $this->templating->render(
            'emails/notify_question.html.twig',
            ['phone' => $clientsPhones]
        ));
    }
}