<?php


namespace App\Form;

use App\Util\FakeTranslator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;

class ClientPhoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $trans = new FakeTranslator();

        $builder
            ->add('mobile', TelType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => $trans->trans('form.clientPhone.placeholder.mobile')
                ]
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'font-semi-bold'
                ],
                'label' => $trans->trans('form.clientPhone.label.submit')
            ])
            ;

    }
}