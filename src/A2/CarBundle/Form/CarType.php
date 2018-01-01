<?php

namespace A2\CarBundle\Form;

use A2\ImageBundle\Form\ImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
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
            ->add('color',      TextType::class) // Réflechir au fait de séparer couleur dans une table, pour permettre la recherche par couleur
            ->add('price',      IntegerType::class)
            ->add('currency',   EntityType::class, array(
                'class'        => 'A2CurrencyBundle:Currency',
                'choice_label' => 'name',
                'multiple'     => false
            ))
            ->add('energy',     TextType::class)
            ->add('co2',        TextType::class)
            ->add('gearBox',    TextType::class)
            ->add('weight',     TextType::class)
            ->add('power',      TextType::class)
            ->add('maxSpeed',   TextType::class)
            ->add('storehouse', EntityType::class, array(
                'class'        => 'A2StorehouseBundle:Storehouse',
                'choice_label' => 'name',
                'multiple'     => false
            ))
            ->add('year',       IntegerType::class)
            ->add('image',      ImageType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'A2\CarBundle\Entity\Car'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'a2_carbundle_car';
    }
}