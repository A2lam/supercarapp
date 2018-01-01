<?php

namespace A2\StockBundle\Controller;

use A2\StockBundle\Entity\Stock;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Stock controller.
 *
 */
class StockController extends Controller
{
    /**
     * Lists all stock entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $stocks = $em
            ->getRepository('A2StockBundle:Stock')
            ->findByIsActive(true)
        ;

        return $this->render('A2StockBundle:Stock:index.html.twig', array(
            'stocks' => $stocks,
        ));
    }

    /**
     * Creates a new stock entity.
     *
     */
    public function newAction(Request $request)
    {
        $stock = new Stock();
        $form = $this->createForm('A2\StockBundle\Form\StockType', $stock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $stock->setAdminAdd($this->getUser()->getId());
            $stock->setDateAdd(new \DateTime());
            $stock->setIsActive(true);

            $em->persist($stock);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Stock bien enregistré');

            return $this->redirectToRoute('a2_stock_show', array('id' => $stock->getId()));
        }

        return $this->render('A2StockBundle:Stock:new.html.twig', array(
            'stock' => $stock,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a stock entity.
     *
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
     * Displays a form to edit an existing stock entity.
     *
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $stock = $em
            ->getRepository('A2StockBundle:Stock')
            ->myFind($id)
        ;

        if (null == $stock)
            throw new NotFoundHttpException("Le stock d'id " .$id. " n'existe pas");

        $editForm = $this->createForm('A2\StockBundle\Form\StockType', $stock);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $stock->setUserUpdate($this->getUser()->getId());
            $stock->setDateUpdate(new \DateTime());

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Stock bien modifié');

            return $this->redirectToRoute('a2_stock_edit', array('id' => $stock->getId()));
        }

        return $this->render('A2StockBundle:Stock:edit.html.twig', array(
            'stock' => $stock,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a stock entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $stock = $em
            ->getRepository('A2StockBundle:Stock')
            ->myFind($id)
        ;

        if (null == $stock)
            throw new NotFoundHttpException("La stock d'id " .$id. " n'existe pas");

        $stock->setIsActive(false);

        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Stock supprimé');

        return $this->redirectToRoute('a2_stock_index');
    }
}