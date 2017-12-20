<?php
/**
 * Created by PhpStorm.
 * User: Allam
 * Date: 22/12/2017
 * Time: 18:00
 */

namespace A2\AddressBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('streetNb',   IntegerType::class)
            ->add('streetName', TextType::class)
            ->add('complement', TextType::class, array('required' => false))
            ->add('zipCode',    IntegerType::class)
            ->add('town',       TextType::class)
            ->add('country',    TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'A2\AddressBundle\Entity\Address'
        ));
    }

    public function getBlockPrefix()
    {
        return 'a2_addressbundle_address';
    }
}