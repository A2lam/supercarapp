<?php

namespace A2\SaleBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SaleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('car',      EntityType::class, array(
                'class'        => 'A2CarBundle:Car',
                'choice_label' => 'model',
                'multiple'     => false
            ))
            ->add('customer', EntityType::class, array(
                'class'        => 'A2CustomerBundle:Customer',
                'choice_label' => 'name',
                'multiple'     => false
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'A2\SaleBundle\Entity\Sale'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'a2_salebundle_sale';
    }
}