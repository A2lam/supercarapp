<?php

namespace A2\CategoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('A2CategoryBundle:Default:index.html.twig');
    }
}
