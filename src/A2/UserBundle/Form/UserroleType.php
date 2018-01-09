<?php
/**
 * Created by PhpStorm.
 * User: Allam
 * Date: 05/01/2018
 * Time: 21:58
 */

namespace A2\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class UserroleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('role', ChoiceType::class, array(
                'choices' => array(
                    'Administrateur'  => 1,
                    'Manager'         => 2,
                    'Vendeur'         => 3
                )
            ))
        ;
    }
}