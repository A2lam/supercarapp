<?php

namespace A2\StockBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StockType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category',   EntityType::class, array(
                'class'        => 'A2CategoryBundle:Category',
                'choice_label' => 'name',
                'multiple'     => false
            ))
            ->add('model',      EntityType::class, array(
                'class'        => 'A2ModelBundle:Model',
                'choice_label' => 'name',
                'multiple'     => false
            ))
            ->add('quantity',   IntegerType::class)
            ->add('dateUpdate', DateType::class)
            ->add('storehouse', EntityType::class, array(
                'class'        => 'A2StorehouseBundle:Storehouse',
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
            'data_class' => 'A2\StockBundle\Entity\Stock'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'a2_stockbundle_stock';
    }
}