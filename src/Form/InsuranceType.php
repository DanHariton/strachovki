<?php

namespace App\Form;

use App\Util\FakeTranslator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
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
            ->add('startDate', DateType::class, [
                'label' => $trans->trans('form.insurance.startDate.label'),
                'widget' => 'single_text'
            ])
            ->add('insuranceDuration', ChoiceType::class, [
                'label' => $trans->trans('form.insurance.duration.label'),
                'choices' => [
                    $trans->trans('form.insurance.duration.choice.threeMonth') => 3,
                    $trans->trans('form.insurance.duration.choice.fourMonth') => 4,
                    $trans->trans('form.insurance.duration.choice.fiveMonth') => 5,
                    $trans->trans('form.insurance.duration.choice.sixMonth') => 6,
                    $trans->trans('form.insurance.duration.choice.sevenMonth') => 7,
                    $trans->trans('form.insurance.duration.choice.eightMonth') => 8,
                    $trans->trans('form.insurance.duration.choice.nineMonth') => 9,
                    $trans->trans('form.insurance.duration.choice.tenMonth') => 10,
                    $trans->trans('form.insurance.duration.choice.elevenMonth') => 11,
                    $trans->trans('form.insurance.duration.choice.year') => 12,
                    $trans->trans('form.insurance.duration.choice.twoYears') => 24
                ],
            ])
            ->add('endDate', DateType::class, [
                'attr' => [
                    'readonly' => true
                ],
                'label' => $trans->trans('form.insurance.endDate.label'),
                'widget' => 'single_text'
            ])
            ->add('price', TextType::class, [
                'attr' => [
                    'readonly' => true
                ],
                'label' => $trans->trans('form.insurance.price.label'),
            ])
            ->add('dateBirth', BirthdayType::class, [
                'label' => $trans->trans('form.insurance.birthDate.label'),
                'format' => 'dd MM yyyy',
                'placeholder' => [
                    'year' => $trans->trans('form.insurance.birthDate.placeholder.year'),
                    'month' => $trans->trans('form.insurance.birthDate.placeholder.month'),
                    'day' => $trans->trans('form.insurance.birthDate.placeholder.date'),
                ]
            ])
            ->add('clientName', TextType::class, [
                'label' => $trans->trans('form.insurance.name.label')
            ])
            ->add('clientSName', TextType::class, [
                'label' => $trans->trans('form.insurance.sName.label')
            ])
            ->add('clientEmail', EmailType::class, [
                'label' => $trans->trans('form.insurance.email.label')
            ])
            ->add('clientMobile', TextType::class, [
                'label' => $trans->trans('form.insurance.mobile.label')
            ])
            ->add('gender', ChoiceType::class, [
                'label' => $trans->trans('form.insurance.gender.label'),
                'choices' => [
                    $trans->trans('form.insurance.gender.choice.m') => 'M',
                    $trans->trans('form.insurance.gender.choice.f') => 'F',
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => $trans->trans('form.insurance.country.label')
            ])
            ->add('town', TextType::class, [
                'label' => $trans->trans('form.insurance.town.label')
            ])
            ->add('street', TextType::class, [
                'label' => $trans->trans('form.insurance.street.label')
            ])
            ->add('postCode', TextType::class, [
                'label' => $trans->trans('form.insurance.postCode.label')
            ])
            ->add('passportId', TextType::class, [
                'label' => $trans->trans('form.insurance.passport.label')
            ])
            ->add('citizenship', CountryType::class, [
                'label' => $trans->trans('form.insurance.citizenShip.label')
            ])
            ->add('save', SubmitType::class, [
                'label' => $trans->trans('form.insurance.button.save')
            ])
        ;


    }
}