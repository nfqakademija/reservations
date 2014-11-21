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
            ->add('peopleAmount', 'choice', array(
                    'choices' => $this->getChoices(),
                    'empty_value' => 'reservations.frontend.reservation.choice'
                ))
            ->add('date', 'date', array(
                    'widget' => 'single_text'
                ))
            ->add('time', 'time', array(
                    'with_minutes' => false,
                    'empty_value' => 'reservations.frontend.reservation.choice'
                ))
            ->add('name')
            ->add('email')
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

    /**
     * Make array of integer choices
     * @return array
     */
    private function getChoices()
    {
        $choices = array();
        for ($i = 1; $i <= 15; $i++) {
            $choices[$i] = $i;
        }
        return $choices;
    }
}
