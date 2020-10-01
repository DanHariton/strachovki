<?php

namespace App\Form;

use App\Entity\Insurance;
use App\Util\FakeTranslator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InsuranceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $trans = new FakeTranslator();

        if ($options['insuranceType'] == Insurance::INSURANCE_TYPE_COMPLEX) {
            $builder
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
                        $trans->trans('form.insurance.duration.choice.thirteenMonth') => 13,
                        $trans->trans('form.insurance.duration.choice.fourteenMonth') => 14,
                        $trans->trans('form.insurance.duration.choice.fifteenMonth') => 15,
                        $trans->trans('form.insurance.duration.choice.sixteenMonth') => 16,
                        $trans->trans('form.insurance.duration.choice.seventeenMonth') => 17,
                        $trans->trans('form.insurance.duration.choice.eighteenMonth') => 18,
                        $trans->trans('form.insurance.duration.choice.nineteenMonth') => 19,
                        $trans->trans('form.insurance.duration.choice.twentyMonth') => 20,
                        $trans->trans('form.insurance.duration.choice.twentyOneMonth') => 21,
                        $trans->trans('form.insurance.duration.choice.twentyTwoMonth') => 22,
                        $trans->trans('form.insurance.duration.choice.twentyThreeMonth') => 23,
                        $trans->trans('form.insurance.duration.choice.twoYears') => 24
                    ],
                    'data' => 12
                ]);
        } else {
            $builder
                ->add('insuranceDuration', ChoiceType::class, [
                    'label' => $trans->trans('form.insurance.duration.label'),
                    'choices' => [
                        $trans->trans('form.insurance.duration.choice.oneMonth') => 1,
                        $trans->trans('form.insurance.duration.choice.twoMonth') => 2,
                        $trans->trans('form.insurance.duration.choice.threeMonth') => 3,
                        $trans->trans('form.insurance.duration.choice.fourMonth') => 4,
                        $trans->trans('form.insurance.duration.choice.fiveMonth') => 5,
                        $trans->trans('form.insurance.duration.choice.sixMonth') => 6,
                        $trans->trans('form.insurance.duration.choice.sevenMonth') => 7,
                        $trans->trans('form.insurance.duration.choice.eightMonth') => 8,
                        $trans->trans('form.insurance.duration.choice.nineMonth') => 9,
                        $trans->trans('form.insurance.duration.choice.tenMonth') => 10,
                        $trans->trans('form.insurance.duration.choice.elevenMonth') => 11,
                        $trans->trans('form.insurance.duration.choice.year') => 12
                    ],
                    'data' => 1
                ]);
        }

        $builder
            ->add('startDate', DateType::class, [
                'label' => $trans->trans('form.insurance.startDate.label'),
                'widget' => 'single_text'
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
                'widget' => 'choice',
                'years' => range(2020, 1960),
                'placeholder' => [
                    'year' => $trans->trans('form.insurance.birthDate.placeholder.year'),
                    'month' => $trans->trans('form.insurance.birthDate.placeholder.month'),
                    'day' => $trans->trans('form.insurance.birthDate.placeholder.date'),
                ]
            ])
            ->add('clientName', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.name.placeholder')
                ],
                'label' => $trans->trans('form.insurance.name.label')
            ])
            ->add('clientSName', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.sName.placeholder')
                ],
                'label' => $trans->trans('form.insurance.sName.label')
            ])
            ->add('clientEmail', EmailType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.email.placeholder')
                ],
                'label' => $trans->trans('form.insurance.email.label')
            ])
            ->add('clientMobile', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.mobile.placeholder')
                ],
                'label' => $trans->trans('form.insurance.mobile.label')
            ])
            ->add('gender', ChoiceType::class, [
                'label' => $trans->trans('form.insurance.gender.label'),
                'empty_data' => true,
                'choices' => [
                    $trans->trans('form.insurance.gender.label') => '',
                    $trans->trans('form.insurance.gender.choice.m') => 'M',
                    $trans->trans('form.insurance.gender.choice.f') => 'F',
                ]
            ])
            ->add('town', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.town.placeholder')
                ],
                'label' => $trans->trans('form.insurance.town.label')
            ])
            ->add('street', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.street.placeholder')
                ],
                'label' => $trans->trans('form.insurance.street.label')
            ])
            ->add('postCode', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.postCode.placeholder')
                ],
                'label' => $trans->trans('form.insurance.postCode.label')
            ])
            ->add('passportId', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.passport.placeholder')
                ],
                'label' => $trans->trans('form.insurance.passport.label')
            ])
            ->add('citizenship', CountryType::class, [
                'placeholder' => $trans->trans('form.insurance.citizenShip.placeholder'),
                'label' => $trans->trans('form.insurance.citizenShip.label'),
                'preferred_choices' => [
                    'CZ', 'UA', 'RU', 'KZ', 'BY'
                ],
            ])
            ->add('nameInsurant', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.nameInsurant.placeholder')
                ],
                'label' => $trans->trans('form.insurance.name.label')
            ])
            ->add('snameInsurant', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.snameInsurant.placeholder')
                ],
                'label' => $trans->trans('form.insurance.sName.label')
            ])
            ->add('emailInsurant', EmailType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.email.placeholder')
                ],
                'label' => $trans->trans('form.insurance.email.label')
            ])
            ->add('mobileInsurant', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.mobile.placeholder')
                ],
                'label' => $trans->trans('form.insurance.mobile.label')
            ])
            ->add('genderInsurant', ChoiceType::class, [
                'label' => $trans->trans('form.insurance.gender.label'),
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
                'label' => $trans->trans('form.insurance.town.label')
            ])
            ->add('streetInsurant', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.street.placeholder')
                ],
                'label' => $trans->trans('form.insurance.street.label')
            ])
            ->add('postCodeInsurant', TextType::class, [
                'attr' => [
                    'placeholder' => $trans->trans('form.insurance.postCode.placeholder')
                ],
                'label' => $trans->trans('form.insurance.postCode.label')
            ])
            ->add('dateBirthInsurant', BirthdayType::class, [
                'label' => $trans->trans('form.insurance.dateBirthInsurant.label'),
                'format' => 'dd MM yyyy',
                'widget' => 'choice',
                'years' => range(2020, 1960),
                'placeholder' => [
                    'year' => $trans->trans('form.insurance.birthDate.placeholder.year'),
                    'month' => $trans->trans('form.insurance.birthDate.placeholder.month'),
                    'day' => $trans->trans('form.insurance.birthDate.placeholder.date'),
                ]
            ])
            ->add('paymentMethod', ChoiceType::class, [
                'label' => $trans->trans('form.insurance.paymentMethod.label'),
                'required' => true,
                'choices' => [
                    $trans->trans('form.insurance.paymentMethod.label') => '',
                    $trans->trans('form.insurance.paymentMethod.choice.payOnline') => Insurance::PAYMENT_METHOD_ONLINE,
                    $trans->trans('form.insurance.paymentMethod.choice.payCash') => Insurance::PAYMENT_METHOD_CASH,
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => $trans->trans('form.insurance.button.save'),
                'attr' => [
                    'class' => 'submit-button hide text-uppercase'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'insuranceType' => null,
        ]);
    }
}