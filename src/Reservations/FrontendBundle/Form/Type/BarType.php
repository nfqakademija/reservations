<?php

namespace Reservations\FrontendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BarType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('address')
            ->add('city')
            ->add('phone')
            ->add('tags')
            ->add('seats')
            ->add('lat')
            ->add('lng')
            ->add('status', 'choice', array(
                    'choices'   => array('1' => 'Ne', '0' => 'Taip')
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Reservations\CoreBundle\Entity\Bar'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'reservations_corebundle_bar';
    }
}
