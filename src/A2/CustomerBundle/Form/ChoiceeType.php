<?php
/**
 * Created by PhpStorm.
 * User: Allam
 * Date: 05/01/2018
 * Time: 21:58
 */

namespace A2\CustomerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class ChoiceeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('choice', ChoiceType::class, array(
                'choices' => array(
                    'Nouveau client'  => 1,
                    'Client existant' => 2
                )
            ))
        ;
    }
}