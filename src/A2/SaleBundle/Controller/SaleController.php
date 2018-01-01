<?php

namespace A2\SaleBundle\Controller;

use A2\SaleBundle\Entity\Sale;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Sale controller.
 *
 */
class SaleController extends Controller
{
    /**
     * Lists all sale entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sales = $em
            ->getRepository('A2SaleBundle:Sale')
            ->findByIsActive(true)
        ;

        return $this->render('A2SaleBundle:Sale:index.html.twig', array(
            'sales' => $sales,
        ));
    }

    /**
     * Creates a new sale entity.
     *
     */
    public function newAction(Request $request)
    {
        $sale = new Sale();
        $form = $this->createForm('A2\SaleBundle\Form\SaleType', $sale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $sale->setAdminAdd($this->getUser()->getId());
            $sale->setDateAdd(new \DateTime());
            $sale->setIsActive(true);

            $em->persist($sale);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Vente bien enregistrée');

            return $this->redirectToRoute('a2_sale_show', array('id' => $sale->getId()));
        }

        return $this->render('A2SaleBundle:Sale:new.html.twig', array(
            'sale' => $sale,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sale entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $sale = $em
            ->getRepository('A2SaleBundle:Sale')
            ->myFind($id)
        ;

        if (null == $sale)
            throw new NotFoundHttpException("La vente d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2SaleBundle:Sale')
            ->getAdminName($sale, 'add')
        ;

        return $this->render('A2SaleBundle:Sale:show.html.twig', array(
            'sale' => $sale,
            'nameAdminAdd' => $nameAdminAdd
        ));
    }

    /**
     * Displays a form to edit an existing sale entity.
     *
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $sale = $em
            ->getRepository('A2SaleBundle:Sale')
            ->myFind($id)
        ;

        if (null == $sale)
            throw new NotFoundHttpException("La vente d'id " .$id. " n'existe pas");

        $editForm = $this->createForm('A2\SaleBundle\Form\SaleType', $sale);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $sale->setUserUpdate($this->getUser()->getId());
            $sale->setDateUpdate(new \DateTime());

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Vente bien modifiée');

            return $this->redirectToRoute('a2_sale_edit', array('id' => $sale->getId()));
        }

        return $this->render('A2SaleBundle:Sale:edit.html.twig', array(
            'sale' => $sale,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a sale entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $sale = $em
            ->getRepository('A2SaleBundle:Sale')
            ->myFind($id)
        ;

        if (null == $sale)
            throw new NotFoundHttpException("La vente d'id " .$id. " n'existe pas");

        $sale->setIsActive(false);

        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Vente supprimée');

        return $this->redirectToRoute('a2_sale_index');
    }
}