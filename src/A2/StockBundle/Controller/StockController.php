<?php

namespace A2\StockBundle\Controller;

use A2\StockBundle\Entity\Stock;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Stock controller.
 *
 */
class StockController extends Controller
{
    /**
     * Lists all stock entities.
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm('CoreBundle\Form\SearchType', null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if (!null == $data)
            {
                $stocks = $em
                    ->getRepository('A2StockBundle:Stock')
                    ->findByKeyword($data['searchString'])
                ;

                return $this->render('A2OrderBundle:Orders:index.html.twig', array(
                    'stocks' => $stocks,
                    'form' => $form->createView()
                ));
            }
        }

        $stocks = $em
            ->getRepository('A2StockBundle:Stock')
            ->findBy(
                array('isActive' => true),
                array('dateAdd'  => 'DESC')
            )
        ;

        return $this->render('A2StockBundle:Stock:index.html.twig', array(
            'stocks' => $stocks,
            'form' => $form->createView()
        ));
    }

    /**
     * Finds and displays a stock entity.
     * @Security("has_role('ROLE_MANAGER')")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $stock = $em
            ->getRepository('A2StockBundle:Stock')
            ->myFind($id)
        ;

        if (null == $stock)
            throw new NotFoundHttpException("Le stock d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2StockBundle:Stock')
            ->getAdminName($stock, 'add')
        ;

        return $this->render('A2StockBundle:Stock:show.html.twig', array(
            'stock' => $stock,
            'nameAdminAdd' => $nameAdminAdd
        ));
    }

    /**
     * Deletes a stock entity.
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $stock = $em
            ->getRepository('A2StockBundle:Stock')
            ->myFind($id)
        ;

        if (null == $stock)
            throw new NotFoundHttpException("Le stock d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2StockBundle:Stock')
            ->getAdminName($stock, 'add')
        ;

        $nameUserUpdate = $em
            ->getRepository('A2StockBundle:Stock')
            ->getAdminName($stock, 'update')
        ;

        $deleteForm = $this->createFormBuilder()->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $stock->setIsActive(false);

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Stock supprimé');

            return $this->redirectToRoute('a2_stock_index');
        }

        return $this->render('A2StockBundle:Stock:delete.html.twig', array(
            'stock'     => $stock,
            'nameAdminAdd'   => $nameAdminAdd,
            'nameUserUpdate' => $nameUserUpdate,
            'delete_form'    => $deleteForm->createView()
        ));
    }
}