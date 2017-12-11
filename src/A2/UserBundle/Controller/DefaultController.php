<?php

namespace A2\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('A2UserBundle:Default:index.html.twig');
    }
}
