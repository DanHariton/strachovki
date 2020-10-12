<?php


namespace App\Form;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class InsurancePriceEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Pojištění',
                'disabled' => true
            ])
            ->add('oneMonth', TextType::class, [
                'required' => false,
                'label' => '1 měsíc'
            ])
            ->add('twoMonth', TextType::class, [
                'required' => false,
                'label' => '2 měsíce'
            ])
            ->add('threeMonth', TextType::class, [
                'label' => '3 měsíce'
            ])
            ->add('fourMonth', TextType::class, [
                'label' => '4 měsíce'
            ])
            ->add('fiveMonth', TextType::class, [
                'label' => '5 měsíců'
            ])
            ->add('sixMonth', TextType::class, [
                'label' => '6 měsíců'
            ])
            ->add('sevenMonth', TextType::class, [
                'label' => '7 měsíců'
            ])
            ->add('eightMonth', TextType::class, [
                'label' => '8 měsíců'
            ])
            ->add('nineMonth', TextType::class, [
                'label' => '9 měsíců'
            ])
            ->add('tenMonth', TextType::class, [
                'label' => '10 měsíců'
            ])
            ->add('elevenMonth', TextType::class, [
                'label' => '11 měsíců'
            ])
            ->add('year', TextType::class, [
                'label' => '12 měsíců'
            ])
            ->add('thirteenMonth', TextType::class, [
                'required' => false,
                'label' => '13 měsíců'
            ])
            ->add('fourteenMonth', TextType::class, [
                'required' => false,
                'label' => '14 měsíců'
            ])
            ->add('fifteenMonth', TextType::class, [
                'required' => false,
                'label' => '15 měsíců'
            ])
            ->add('sixteenMonth', TextType::class, [
                'required' => false,
                'label' => '16 měsíců'
            ])
            ->add('seventeenMonth', TextType::class, [
                'required' => false,
                'label' => '17 měsíců'
            ])
            ->add('eighteenMonth', TextType::class, [
                'required' => false,
                'label' => '18 měsíců'
            ])
            ->add('nineteenMonth', TextType::class, [
                'required' => false,
                'label' => '19 měsíců'
            ])
            ->add('twentyMonth', TextType::class, [
                'required' => false,
                'label' => '20 měsíců'
            ])
            ->add('twentyOneMonth', TextType::class, [
                'required' => false,
                'label' => '21 měsíc'
            ])
            ->add('twentyTwoMonth', TextType::class, [
                'required' => false,
                'label' => '22 měsíců'
            ])
            ->add('twentyThreeMonth', TextType::class, [
                'required' => false,
                'label' => '23 měsíců'
            ])
            ->add('twoYears', TextType::class, [
                'required' => false,
                'label' => '24 měsíců'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Uložit'
            ])
        ;
    }
}