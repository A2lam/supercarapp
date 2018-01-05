<?php
/**
 * Created by PhpStorm.
 * User: Allam
 * Date: 05/01/2018
 * Time: 21:58
 */

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('searchString')
        ;
    }
}