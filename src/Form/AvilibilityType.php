<?php

namespace App\Form;

use App\Entity\Avilibility;
use App\Entity\Day;
use App\Entity\Doctor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvilibilityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('duration')
            ->add('doctor', EntityType::class, [
                'class' => Doctor::class,
'choice_label' => 'id',
            ])
            ->add('Days', EntityType::class, [
                'class' => Day::class,
                'choice_label' => function (Day $day) {
                    // Construct the format "Month Day" using the integer value
                    return date('F j', mktime(0, 0, 0, 1, $day->getDay(), date('Y')));
                },
                'multiple' => true,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avilibility::class,
        ]);
    }
}
