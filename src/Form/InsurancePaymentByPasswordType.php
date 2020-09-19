<?php


namespace App\Form;


use App\Util\FakeTranslator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class InsurancePaymentByPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $trans = new FakeTranslator();

        $builder
            ->add('paymentPassword', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => $trans->trans('form.paymentPassword.placeholder')
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => $trans->trans('form.paymentPassword.submit')
            ])
        ;
    }
}