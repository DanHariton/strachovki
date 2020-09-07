<?php

namespace App\Form;

use App\Entity\Insurance;
use App\Util\FakeTranslator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class InsuranceEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $trans = new FakeTranslator();

        $builder
            ->add('insuranceName', ChoiceType::class, [
                'label' => $trans->trans('form.insurance.insuranceName.label'),
                'choices' => [
                    $trans->trans('form.insurance.insuranceName.choice.ergo') => Insurance::INSURANCE_ERGO,
                    $trans->trans('form.insurance.insuranceName.choice.maxima') => Insurance::INSURANCE_MAXIMA,
                    $trans->trans('form.insurance.insuranceName.choice.pvzp') => Insurance::INSURANCE_PVZP,
                    $trans->trans('form.insurance.insuranceName.choice.uniqa') => Insurance::INSURANCE_UNIQA,
                ]
            ])
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
            ->add('dateBirth', DateType::class, [
                'label' => $trans->trans('form.insurance.birthDate.label'),
                'widget' => 'single_text'
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
            ->add('citizenship', TextType::class, [
                'label' => $trans->trans('form.insurance.citizenShip.label')
            ])
            ->add('nameInsurant', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.nameInsurant.placeholder')
                ],
                'label' => $trans->trans('form.insurance.name.label2')
            ])
            ->add('snameInsurant', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.snameInsurant.placeholder')
                ],
                'label' => $trans->trans('form.insurance.sName.label2')
            ])
            ->add('emailInsurant', EmailType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.email.placeholder')
                ],
                'label' => $trans->trans('form.insurance.email.label2')
            ])
            ->add('mobileInsurant', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.mobile.placeholder')
                ],
                'label' => $trans->trans('form.insurance.mobile.label2')
            ])
            ->add('genderInsurant', ChoiceType::class, [
                'label' => $trans->trans('form.insurance.gender.label2'),
                'empty_data' => true,
                'choices' => [
                    $trans->trans('form.insurance.gender.label') => '',
                    $trans->trans('form.insurance.gender.choice.m') => 'M',
                    $trans->trans('form.insurance.gender.choice.f') => 'F',
                ]
            ])
            ->add('townInsurant', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.town.placeholder')
                ],
                'label' => $trans->trans('form.insurance.town.label2')
            ])
            ->add('streetInsurant', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.street.placeholder')
                ],
                'label' => $trans->trans('form.insurance.street.label2')
            ])
            ->add('postCodeInsurant', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.postCode.placeholder')
                ],
                'label' => $trans->trans('form.insurance.postCode.label2')
            ])
            ->add('dateBirthInsurant', DateType::class, [
                'label' => $trans->trans('form.insurance.dateBirthInsurant.label'),
                'format' => 'dd MM yyyy',
                'widget' => 'single_text',
                'years' => range(2020, 1960),
            ])
            ->add('save', SubmitType::class, [
                'label' => $trans->trans('form.insurance.button.save')
            ])
        ;
    }
}