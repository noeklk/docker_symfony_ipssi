<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Aircraft;
use App\Entity\Flight;

class AircraftType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('manufacturer')
            ->add('basicType');
        // ->add('flight', EntityType::class, array(
        //     'class' => Flight::class,
        //     'choice_label' => 'aircraft'
        // ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Aircraft::class
        ));
    }

    // public function getBlockPrefix()
    // {
    //     return 'app_flight';
    // }
}
