<?php

namespace App\Form;

use App\Entity\Doctor;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoctorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('specialty')
            ->add('officeRegion')
            ->add('officeAddress')
            ->add('officePhone')
            
//             ->add('user', EntityType::class, [
//                 'class' => User::class,
// 'choice_label' => 'id',
//             ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Doctor::class,
        ]);
    }
}
