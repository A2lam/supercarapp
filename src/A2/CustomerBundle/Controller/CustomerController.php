<?php

namespace A2\CustomerBundle\Controller;

use A2\CustomerBundle\Entity\Customer;
use A2\SaleBundle\Entity\Sale;
use Doctrine\Common\Collections\ArrayCollection;
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
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm('CoreBundle\Form\SearchType', null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if (!null == $data)
            {
                $customers = $em
                    ->getRepository('A2CustomerBundle:Customer')
                    ->findByKeyword($data['searchString'])
                ;

                return $this->render('A2CustomerBundle:Customer:index.html.twig', array(
                    'customers' => $customers,
                    'form' => $form->createView()
                ));
            }
        }

        $customers = $em
            ->getRepository('A2CustomerBundle:Customer')
            ->findBy(
                array('isActive' => true),
                array('dateAdd'  => 'DESC')
            )
        ;

        return $this->render('A2CustomerBundle:Customer:index.html.twig', array(
            'customers' => $customers,
            'form' => $form->createView()
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

            $car = $em
                ->getRepository('A2CarBundle:Car')
                ->myFind($id)
            ;

            if (null == $car)
                throw new NotFoundHttpException("La voiture d'id id n'existe pas");

            // Enregistrement du client
            $customer->addCar($car);
            $customer->setAdminAdd($this->getUser()->getId());
            $customer->setDateAdd(new \DateTime());
            $customer->setIsActive(true);
            $em->persist($customer);
            $em->flush();

            // Enregistrement de la vente
            $sale = new Sale();
            $sale->setCar($car);
            $sale->setCustomer($customer);
            $sale->setAdminAdd($this->getUser()->getId());
            $sale->setDateAdd(new \DateTime());
            $sale->setIsActive(true);
            $em->persist($sale);
            $em->flush();

            // Marquage de la voiture comme vendu et diminution du stock
            $car->setIsSold(true);
            $stock = $em
                ->getRepository('A2StockBundle:Stock')
                ->findByModelAndStorehouse($car->getModel(), $car->getStorehouse())
            ;
            if (!null == $stock)
                $stock->setQuantity($stock->getQuantity() - 1);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Client et vente bien enregistrée');

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

        $carsId = $em
            ->getRepository('A2SaleBundle:Sale')
            ->getCustomerCars($customer)
        ;

        foreach ($carsId as $key => $value)
        {
            $sale = $em
                ->getRepository('A2SaleBundle:Sale')
                ->myFind($value)
            ;

            if (!null == $sale)
                $customer->addCar($sale->getCar());
        }

        $nameAdminAdd = $em
            ->getRepository('A2CustomerBundle:Customer')
            ->getAdminName($customer, 'add')
        ;

        $nameUserUpdate = $em
            ->getRepository('A2CustomerBundle:Customer')
            ->getAdminName($customer, 'update')
        ;

        return $this->render('A2CustomerBundle:Customer:show.html.twig', array(
            'customer' => $customer,
            'nameAdminAdd' => $nameAdminAdd,
            'nameUserUpdate' => $nameUserUpdate
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

            return $this->redirectToRoute('a2_customer_show', array('id' => $customer->getId()));
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
        $customerForm = $this->createForm('A2\CustomerBundle\Form\ClientType', null);
        $customerForm->handleRequest($request);

        if ($customerForm->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();

            $car = $em
                ->getRepository('A2CarBundle:Car')
                ->myFind($id)
            ;

            if (null == $car)
                throw new NotFoundHttpException("La voiture d'id " .$id. " n'existe pas");

            $customer = $customerForm->get('customer')->getData();

            if (null == $customer)
                throw new NotFoundHttpException("Le client d'id " .$id. " n'existe pas");

            $customer->addCar($car);
            $customer->setUserUpdate($this->getUser()->getId());
            $customer->setDateUpdate(new \DateTime());

            $em->persist($customer);

            // Enregistrement de la vente
            $sale = new Sale();
            $sale->setCar($car);
            $sale->setCustomer($customer);
            $sale->setAdminAdd($this->getUser()->getId());
            $sale->setDateAdd(new \DateTime());
            $sale->setIsActive(true);

            $em->persist($sale);

            // Marquage de la voiture comme vendu et diminution du stock
            $car->setIsSold(true);
            $stock = $em
                ->getRepository('A2StockBundle:Stock')
                ->findByModelAndStorehouse($car->getModel(), $car->getStorehouse())
            ;
            if (!null == $stock)
                $stock->setQuantity($stock->getQuantity() - 1);

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Vente bien enregistrée');

            return $this->redirectToRoute('a2_customer_show', array('id' => $customer->getId()));
        }

        return $this->render('A2CustomerBundle:Customer:sale.html.twig', array(
            'id'        => $id,
            'customer_form'  => $customerForm->createView()
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

        $carsId = $em
            ->getRepository('A2SaleBundle:Sale')
            ->getCustomerCars($customer)
        ;

        foreach ($carsId as $carId)
        {
            $car = $em
                ->getRepository('A2CarBundle:Car')
                ->find($carId)
            ;

            if (!null == $car)
                $customer->addCar($car);
        }

        $nameAdminAdd = $em
            ->getRepository('A2CustomerBundle:Customer')
            ->getAdminName($customer, 'add')
        ;

        $nameUserUpdate = $em
            ->getRepository('A2CustomerBundle:Customer')
            ->getAdminName($customer, 'update')
        ;

        $deleteForm = $this->createFormBuilder()->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $customer->setIsActive(false);

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Client supprimé');

            return $this->redirectToRoute('a2_customer_index');
        }

        return $this->render('A2CustomerBundle:Customer:delete.html.twig', array(
            'customer'     => $customer,
            'nameAdminAdd' => $nameAdminAdd,
            'nameUserUpdate' => $nameUserUpdate,
            'delete_form' => $deleteForm->createView()
        ));
    }
}