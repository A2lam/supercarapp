<?php
/**
 * Created by PhpStorm.
 * User: Allam
 * Date: 10/01/2018
 * Time: 02:20
 */

namespace A2\CustomerBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customer',      EntityType::class, array(
                'class'        => 'A2CustomerBundle:Customer',
                'choice_label' => 'fullName',
                'multiple'     => false
            ))
        ;
    }
}