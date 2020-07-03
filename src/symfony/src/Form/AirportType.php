<?php

namespace App\Form;

use App\Entity\Airport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AirportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ident')
            ->add('typeA')
            ->add('name')
            ->add('latitudeDeg')
            ->add('longitudeDeg')
            ->add('elevationFt')
            ->add('isoCountry')
            ->add('municipality')
            ->add('iataCode')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Airport::class,
        ]);
    }
}
