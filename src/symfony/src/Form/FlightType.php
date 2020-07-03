<?php

namespace App\Form;

use App\Entity\Aircraft;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Airport;
use App\Entity\Flight;

class FlightType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number')
            ->add('departure', EntityType::class, array(
                'class' => Airport::class,
                'choice_label' => 'name'
            ))
            ->add('arrival', EntityType::class, array(
                'class' => Airport::class,
                'choice_label' => 'name'
            ))
            ->add('aircraft', EntityType::class, array(
                'class' => Aircraft::class,
                'choice_label' => 'basicType'
            ))
            ->add('price')
            ->add('save', SubmitType::class, ['label' => 'Enregistrer']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Flight::class
        ));
    }

    // public function getBlockPrefix()
    // {
    //     return 'app_flight';
    // }
}
