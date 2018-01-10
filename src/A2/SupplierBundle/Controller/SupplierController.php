<?php

namespace A2\SupplierBundle\Controller;

use A2\SupplierBundle\Entity\Supplier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Supplier controller.
 *
 */
class SupplierController extends Controller
{
    /**
     * Lists all supplier entities.
     *
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
                $suppliers = $em
                    ->getRepository('A2SupplierBundle:Supplier')
                    ->findByKeyword($data['searchString'])
                ;

                return $this->render('A2SupplierBundle:Supplier:index.html.twig', array(
                    'suppliers' => $suppliers,
                    'form' => $form->createView()
                ));
            }
        }

        $suppliers = $em
            ->getRepository('A2SupplierBundle:Supplier')
            ->findBy(
                array('isActive' => true),
                array('dateAdd'  => 'DESC')
            )
        ;

        return $this->render('A2SupplierBundle:Supplier:index.html.twig', array(
            'suppliers' => $suppliers,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a new supplier entity.
     *
     */
    public function newAction(Request $request)
    {
        $supplier = new Supplier();
        $form = $this->createForm('A2\SupplierBundle\Form\SupplierType', $supplier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $supplier->setAdminAdd($this->getUser()->getId());
            $supplier->setDateAdd(new \DateTime());
            $supplier->setIsActive(true);

            $em->persist($supplier);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Fournisseur bien enregistré');

            return $this->redirectToRoute('a2_supplier_show', array('id' => $supplier->getId()));
        }

        return $this->render('A2SupplierBundle:Supplier:new.html.twig', array(
            'supplier' => $supplier,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a supplier entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $supplier = $em
            ->getRepository('A2SupplierBundle:Supplier')
            ->myFind($id)
        ;

        if (null == $supplier)
            throw new NotFoundHttpException("Le fournisseur d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2SupplierBundle:Supplier')
            ->getAdminName($supplier, 'add')
        ;

        $nameUserUpdate = $em
            ->getRepository('A2SupplierBundle:Supplier')
            ->getAdminName($supplier, 'update')
        ;

        return $this->render('A2SupplierBundle:Supplier:show.html.twig', array(
            'supplier' => $supplier,
            'nameAdminAdd' => $nameAdminAdd,
            'nameUserUpdate' => $nameUserUpdate
        ));
    }

    /**
     * Displays a form to edit an existing supplier entity.
     *
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $supplier = $em
            ->getRepository('A2SupplierBundle:Supplier')
            ->myFind($id)
        ;

        if (null == $supplier)
            throw new NotFoundHttpException("'e fournisseur d'id " .$id. " n'existe pas");

        $editForm = $this->createForm('A2\SupplierBundle\Form\SupplierType', $supplier);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $supplier->setUserUpdate($this->getUser()->getId());
            $supplier->setDateUpdate(new \DateTime());

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Fournisseur bien modifié');

            return $this->redirectToRoute('a2_supplier_show', array('id' => $supplier->getId()));
        }

        return $this->render('A2SupplierBundle:Supplier:edit.html.twig', array(
            'supplier' => $supplier,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a supplier entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $supplier = $em
            ->getRepository('A2SupplierBundle:Supplier')
            ->myFind($id)
        ;

        if (null == $supplier)
            throw new NotFoundHttpException("Le fournisseur d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2SupplierBundle:Supplier')
            ->getAdminName($supplier, 'add')
        ;

        $nameUserUpdate = $em
            ->getRepository('A2SupplierBundle:Supplier')
            ->getAdminName($supplier, 'update')
        ;

        $deleteForm = $this->createFormBuilder()->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $supplier->setIsActive(false);

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Fournisseur supprimé');

            return $this->redirectToRoute('a2_supplier_index');
        }

        return $this->render('A2SupplierBundle:Supplier:delete.html.twig', array(
            'supplier'     => $supplier,
            'nameAdminAdd'   => $nameAdminAdd,
            'nameUserUpdate' => $nameUserUpdate,
            'delete_form'    => $deleteForm->createView()
        ));
    }
}