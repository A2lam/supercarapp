<?php

namespace A2\AddressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('A2AddressBundle:Default:index.html.twig');
    }
}
