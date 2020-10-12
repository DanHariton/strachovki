<?php


namespace App\Form;


use App\Util\FakeTranslator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BankReferenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $trans = new FakeTranslator();

        $builder
            ->add('nameClient', TextType::class, [
                'label' => $trans->trans('form.bankReference.nameClient.label'),
                'attr' => [
                    'placeholder' => $trans->trans('form.bankReference.nameClient.placeholder')
                ]
            ])
            ->add('snameClient', TextType::class, [
                'label' => $trans->trans('form.bankReference.snameClient.label'),
                'attr' => [
                    'placeholder' => $trans->trans('form.bankReference.snameClient.placeholder')
                ]
            ])
            ->add('email', TextType::class, [
                'label' => $trans->trans('form.bankReference.email.label'),
                'attr' => [
                    'placeholder' => $trans->trans('form.bankReference.email.placeholder')
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => $trans->trans('form.bankReference.phone.label'),
                'attr' => [
                    'placeholder' => $trans->trans('form.clientPhone.placeholder.mobile')
                ]
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'font-semi-bold submit-button text-uppercase mt-3'
                ],
                'label' => $trans->trans('form.bankReference.submit.label')
            ])
        ;

    }
}