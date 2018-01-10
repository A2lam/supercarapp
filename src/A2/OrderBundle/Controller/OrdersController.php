<?php

namespace A2\OrderBundle\Controller;

use A2\OrderBundle\Entity\Orders;
use A2\StockBundle\Entity\Stock;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Order controller.
 *
 */
class OrdersController extends Controller
{
    /**
     * Lists all order entities.
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
                $orders = $em
                    ->getRepository('A2OrderBundle:Orders')
                    ->findByKeyword($data['searchString'])
                ;

                return $this->render('A2OrderBundle:Orders:index.html.twig', array(
                    'orders' => $orders,
                    'form' => $form->createView()
                ));
            }
        }

        $orders = $em
            ->getRepository('A2OrderBundle:Orders')
            ->findBy(
                array('isActive' => true),
                array('dateAdd'  => 'DESC')
            )
        ;

        return $this->render('A2OrderBundle:Orders:index.html.twig', array(
            'orders' => $orders,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a new order entity.
     *
     */
    public function newAction(Request $request)
    {
        $order = new Orders();
        $form = $this->createForm('A2\OrderBundle\Form\OrdersType', $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $order->setAdminAdd($this->getUser()->getId());
            $order->setDateAdd(new \DateTime());
            $order->setIsReceived(false);
            $order->setIsActive(true);

            $em->persist($order);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Commande bien enregistrée');

            return $this->redirectToRoute('a2_orders_show', array('id' => $order->getId()));
        }

        return $this->render('A2OrderBundle:Orders:new.html.twig', array(
            'order' => $order,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a order entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $order = $em
            ->getRepository('A2OrderBundle:Orders')
            ->myFind($id)
        ;

        if (null == $order)
            throw new NotFoundHttpException("La commande d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2OrderBundle:Orders')
            ->getAdminName($order, 'add')
        ;

        $nameUserUpdate = $em
            ->getRepository('A2OrderBundle:Orders')
            ->getAdminName($order, 'update')
        ;

        return $this->render('A2OrderBundle:Orders:show.html.twig', array(
            'order' => $order,
            'nameAdminAdd' => $nameAdminAdd,
            'nameUserUpdate' => $nameUserUpdate
        ));
    }

    /**
     * Displays a form to edit an existing order entity.
     *
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $order = $em
            ->getRepository('A2OrderBundle:Orders')
            ->myFind($id)
        ;

        if (null == $order)
            throw new NotFoundHttpException("La commande d'id " .$id. " n'existe pas");

        $editForm = $this->createForm('A2\OrderBundle\Form\OrdersType', $order);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $order->setUserUpdate($this->getUser()->getId());
            $order->setDateUpdate(new \DateTime());

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Commande bien modifiée');

            return $this->redirectToRoute('a2_orders_show', array('id' => $order->getId()));
        }

        return $this->render('A2OrderBundle:Orders:edit.html.twig', array(
            'order' => $order,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Etablissement d'une commande comme étant "Reçu"
     */
    public function receivedAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $order = $em
            ->getRepository('A2OrderBundle:Orders')
            ->myFind($id)
        ;

        if (null == $order)
            throw new NotFoundHttpException("La commande d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2OrderBundle:Orders')
            ->getAdminName($order, 'add')
        ;

        $nameUserUpdate = $em
            ->getRepository('A2OrderBundle:Orders')
            ->getAdminName($order, 'update')
        ;

        $receivedForm = $this->createFormBuilder()->getForm();
        $receivedForm->handleRequest($request);

        if ($receivedForm->isSubmitted() && $receivedForm->isValid()) {
            $order->setIsReceived(true);

            // Tentative de verification s'il exite déjà un stock pour ce modèle et cet entrepot
            $stock = $em
                ->getRepository('A2StockBundle:Stock')
                ->findByModelAndStorehouse($order->getModel(), $order->getStorehouse())
            ;

            if (null == $stock)
            {
                $stock = new Stock();

                $stock->setCategory($order->getCategory());
                $stock->setModel($order->getModel());
                $stock->setStorehouse($order->getStorehouse());
                $stock->setQuantity($order->getQuantity());
                $stock->setAdminAdd($this->getUser()->getId());
                $stock->setDateAdd(new \DateTime());
                $stock->setIsActive(true);

                $em->persist($stock);
            }
            else
            {
                $stock->setQuantity($stock->getQuantity() + $order->getQuantity());
                $stock->setUserUpdate($this->getUser()->getId());
                $stock->setDateUpdate(new \DateTime());
            }

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Stock Mis à jour');

            return $this->redirectToRoute('a2_stock_index');
        }

        return $this->render('A2OrderBundle:Orders:received.html.twig', array(
            'order'          => $order,
            'nameAdminAdd'   => $nameAdminAdd,
            'nameUserUpdate' => $nameUserUpdate,
            'received_form'  => $receivedForm->createView()
        ));
    }

    /**
     * Deletes a order entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $order = $em
            ->getRepository('A2OrderBundle:Orders')
            ->myFind($id)
        ;

        if (null == $order)
            throw new NotFoundHttpException("La commande d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2OrderBundle:Orders')
            ->getAdminName($order, 'add')
        ;

        $nameUserUpdate = $em
            ->getRepository('A2OrderBundle:Orders')
            ->getAdminName($order, 'update')
        ;

        $deleteForm = $this->createFormBuilder()->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $order->setIsActive(false);

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Commande supprimée');

            return $this->redirectToRoute('a2_orders_index');
        }

        return $this->render('A2OrderBundle:Orders:delete.html.twig', array(
            'order'     => $order,
            'nameAdminAdd'   => $nameAdminAdd,
            'nameUserUpdate' => $nameUserUpdate,
            'delete_form'    => $deleteForm->createView()
        ));
    }
}