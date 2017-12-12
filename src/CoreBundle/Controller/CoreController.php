<?php
/**
 * Created by PhpStorm.
 * User: Allam
 * Date: 14/12/2017
 * Time: 17:47
 */

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function accueilAction()
    {
        $this->render('CoreBundle:Core:accueil.html.twig');
    }
}