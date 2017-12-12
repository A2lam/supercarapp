<?php

namespace A2\StorehouseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('A2StorehouseBundle:Default:index.html.twig');
    }
}
