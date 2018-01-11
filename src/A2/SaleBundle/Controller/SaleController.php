<?php

namespace A2\SaleBundle\Controller;

use A2\SaleBundle\Entity\Sale;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Sale controller.
 *
 */
class SaleController extends Controller
{
    /**
     * Lists all sale entities.
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
                $sales = $em
                    ->getRepository('A2SaleBundle:Sale')
                    ->findByKeyword($data['searchString'])
                ;

                return $this->render('A2SaleBundle:Sale:index.html.twig', array(
                    'sales' => $sales,
                    'form' => $form->createView()
                ));
            }
        }

        $sales = $em
            ->getRepository('A2SaleBundle:Sale')
            ->findBy(
                array('isActive' => true),
                array('dateAdd'  => 'DESC')
            )
        ;

        return $this->render('A2SaleBundle:Sale:index.html.twig', array(
            'sales' => $sales,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a new sale entity.
     * @Security("has_role('ROLE_USER')")
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
     * @Security("has_role('ROLE_USER')")
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
     * Deletes a sale entity.
     * @Security("has_role('ROLE_USER')")
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

        $nameAdminAdd = $em
            ->getRepository('A2SaleBundle:Sale')
            ->getAdminName($sale, 'add')
        ;

        $deleteForm = $this->createFormBuilder()->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $sale->setIsActive(false);

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Vente supprimée');

            return $this->redirectToRoute('a2_sale_index');
        }

        return $this->render('A2SaleBundle:Sale:delete.html.twig', array(
            'sale'     => $sale,
            'nameAdminAdd' => $nameAdminAdd,
            'delete_form' => $deleteForm->createView()
        ));
    }
}