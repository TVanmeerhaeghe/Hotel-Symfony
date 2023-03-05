<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\SuiteHotel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $suite = $options['suite'];
        $builder
            ->add('nom',TextType::class)
            ->add('mail',TextType::class)
            ->add('tel',TextType::class)
            ->add('date',DateType::class)
            ->add('suite', EntityType::class, [
                'class' => SuiteHotel::class,
                'choices' => [$suite],
                'choice_label' => 'titre', 
                ])
            ->add('Enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
            'suite' => null,
        ]);
    }
}