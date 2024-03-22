<?php

namespace App\Form;

use App\Entity\Appointment;
use App\Entity\Day;
use App\Entity\Hour;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('start_time')
            ->add('appointment', EntityType::class, [
                'class' => Appointment::class,
'choice_label' => 'id',
            ])
            ->add('days', EntityType::class, [
                'class' => Day::class,
'choice_label' => 'id',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hour::class,
        ]);
    }
}
