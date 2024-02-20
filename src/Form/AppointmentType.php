<?php

namespace App\Form;

use App\Entity\Appointment;
use App\Entity\Consultation;
use App\Entity\Patient;
use App\Entity\Secretary;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('hour')
            ->add('patientStatus')
            ->add('progress')
            ->add('patient', EntityType::class, [
                'class' => Patient::class,
'choice_label' => 'id',
            ])
            ->add('secretary', EntityType::class, [
                'class' => Secretary::class,
'choice_label' => 'id',
            ])
            ->add('Consultation', EntityType::class, [
                'class' => Consultation::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }
}