<?php

namespace App\Form;

use App\Entity\Avilibility;
use App\Entity\Day;
use App\Entity\Hour;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('day')
            ->add('avilibilities', EntityType::class, [
                'class' => Avilibility::class,
'choice_label' => 'id',
'multiple' => true,
            ])
            ->add('hours', EntityType::class, [
                'class' => Hour::class,
'choice_label' => 'id',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Day::class,
        ]);
    }
}
