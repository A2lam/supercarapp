<?php

namespace A2\CustomerBundle\Controller;

use A2\CustomerBundle\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Customer controller.
 *
 */
class CustomerController extends Controller
{
    /**
     * Lists all customer entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $customers = $em
            ->getRepository('A2CustomerBundle:Customer')
            ->findByIsActive(true)
        ;

        return $this->render('A2CustomerBundle:Customer:index.html.twig', array(
            'customers' => $customers,
        ));
    }

    /**
     * Creates a new customer entity.
     *
     */
    public function newAction(Request $request, $id)
    {
        $customer = new Customer();
        $form = $this->createForm('A2\CustomerBundle\Form\CustomerType', $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $customer->setAdminAdd($this->getUser()->getId());
            $customer->setDateAdd(new \DateTime());
            $customer->setIsActive(true);

            $em->persist($customer);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Client bien enregistré');

            return $this->redirectToRoute('a2_customer_show', array('id' => $customer->getId()));
        }

        return $this->render('A2CustomerBundle:Customer:new.html.twig', array(
            'customer' => $customer,
            'id' => $id,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a customer entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $customer = $em
            ->getRepository('A2CustomerBundle:Customer')
            ->myFind($id)
        ;

        if (null == $customer)
            throw new NotFoundHttpException("Le client d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2CustomerBundle:Customer')
            ->getAdminName($customer, 'add')
        ;

        return $this->render('A2CustomerBundle:Customer:show.html.twig', array(
            'customer' => $customer,
            'nameAdminAdd' => $nameAdminAdd
        ));
    }

    /**
     * Displays a form to edit an existing customer entity.
     *
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $customer = $em
            ->getRepository('A2CustomerBundle:Customer')
            ->myFind($id)
        ;

        if (null == $customer)
            throw new NotFoundHttpException("Le client d'id " .$id. " n'existe pas");

        $editForm = $this->createForm('A2\CustomerBundle\Form\CustomerType', $customer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $customer->setUserUpdate($this->getUser()->getId());
            $customer->setDateUpdate(new \DateTime());

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Client bien modifié');

            return $this->redirectToRoute('a2_customer_edit', array('id' => $customer->getId()));
        }

        return $this->render('A2CustomerBundle:Customer:edit.html.twig', array(
            'customer' => $customer,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Gestion de la vente a un client existant
     */
    public function saleAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $car = $em
            ->getRepository('A2CarBundle:Car')
            ->myFind($id)
        ;

        if (null == $car)
            throw new NotFoundHttpException("La voiture d'id " .$id. " n'existe pas");

        $customerForm = $this->createForm('A2\CustomerBundle\Form\ClientType', null);
        $customerForm->handleRequest($request);

        //if ($customerForm->isSubmitted() && $customerForm->isValid()) {
        //}

        return $this->render('A2CustomerBundle:Customer:sale.html.twig', array(
            'car'        => $car,
            'sold_form'  => $customerForm->createView()
        ));
    }

    /**
     * Deletes a customer entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $customer = $em
            ->getRepository('A2CustomerBundle:Customer')
            ->myFind($id)
        ;

        if (null == $customer)
            throw new NotFoundHttpException("Le client d'id " .$id. " n'existe pas");

        $customer->setIsActive(false);

        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Client supprimé');

        return $this->redirectToRoute('a2_customer_index');
    }
}