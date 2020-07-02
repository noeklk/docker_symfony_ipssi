<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Airport;

class FlightType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('number')
            ->add('departure', EntityType::class, array(
                'class' => Airport::class,
                'choice_label' => 'name'
            ))
            ->add('arrival', EntityType::class, array(
                'class' => Airport::class,
                'choice_label' => 'name'
            ))
            ->add('enregistrer', SubmitType::class, ['label' => 'Enregistrer']);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Flight'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_flight';
    }
}
