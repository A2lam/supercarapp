<?php

namespace A2\StorehouseBundle\Form;

use A2\AddressBundle\Form\AddressType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StorehouseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',    TextType::class)
            ->add('manager', EntityType::class, array(
                'class'        => 'A2UserBundle:Manager',
                'choice_label' => 'name',
                'multiple'     => false
            ))
            ->add('address', AddressType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'A2\StorehouseBundle\Entity\Storehouse'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'a2_storehousebundle_storehouse';
    }
}