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
        $em = $this->getDoctrine()->getManager();

        $modelsAReguler = array();
        $qteTotal = 0;

        // Verification de la nature de l'utilisateur connecté
        // Pour la récuperation des ses notif personnelles
        $roles = $this->getUser()->getRoles();
        foreach ($roles as $role)
        {
            if ($role == "ROLE_ADMIN")
            {
                $models = $em
                    ->getRepository('A2ModelBundle:Model')
                    ->findByIsActive(true)
                ;

                foreach ($models as $model)
                {
                    // Recuperation de tous les stock concernes
                    $stocks = $em
                        ->getRepository('A2StockBundle:Stock')
                        ->findByModel($model)
                    ;

                    foreach ($stocks as $stock)
                    {
                        $qteTotal += $stock->getQuantity();
                    }

                    if ($qteTotal < $model->getAlertValue())
                        $modelsAReguler[] = $model;

                    $qteTotal = 0;
                }
            }
            //elseif ($role == "ROLE_MANAGER")
            //{

            //}
            //else
            //{
            //    return;
            //}
        }

        // Recupération des recentes notif pour tous les utilisateurs
        $sales = $em
            ->getRepository('A2SaleBundle:Sale')
            ->findBy(
                array('isActive' => true),
                array('dateAdd'  => 'DESC'),
                3,
                0
            )
        ;
        $orders = $em
            ->getRepository('A2OrderBundle:Orders')
            ->findBy(
                array('isActive' => true),
                array('dateAdd'  => 'DESC'),
                3,
                0
            )
        ;

        return $this->render('CoreBundle:Core:accueil.html.twig', array(
            'sales'          => $sales,
            'orders'         => $orders,
            'modelsAReguler' => $modelsAReguler
        ));
    }
}