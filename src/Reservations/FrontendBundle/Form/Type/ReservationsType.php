<?php

namespace Reservations\FrontendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReservationsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('peopleAmount')
            ->add('date', 'date', array('widget' => 'single_text'))
            ->add('time')
            ->add('name')
            ->add('email')
            ->add('save', 'submit', array('label' => 'Create Task'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Reservations\CoreBundle\Entity\Reservations'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'reservations_corebundle_reservations';
    }
}
