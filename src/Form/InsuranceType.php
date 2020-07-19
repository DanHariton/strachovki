<?php

namespace App\Form;

use App\Util\FakeTranslator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;

class InsuranceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $trans = new FakeTranslator();

        $builder
            ->add('insuranceDuration', RangeType::class, [
                'attr' => [
                    'min' => 1,
                    'max' => 24
                ],
            ])
            ->add('startDate', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('dateBirth', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('clientName', TextType::class, [
                'constraints' => [
                    new Length(['min' => 10])
                ]
            ])
            ->add('clientSName', TextType::class)
            ->add('clientEmail', EmailType::class)
            ->add('clientMobile', TextType::class)
            ->add('gender', ChoiceType::class, [
                'label' => $trans->trans('form.insurance.gender.label'),
                'choices' => [
                    $trans->trans('form.insurance.gender.choice.m') => 'M',
                    $trans->trans('form.insurance.gender.choice.f') => 'F',
                ]
            ])
            ->add('country', TextType::class)
            ->add('town', TextType::class)
            ->add('street', TextType::class)
            ->add('postCode', TextType::class)
            ->add('passportId', TextType::class)
            ->add('citizenship', TextType::class)
            ->add('save', SubmitType::class)
        ;


    }
}