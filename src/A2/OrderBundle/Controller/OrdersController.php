<?php

namespace A2\OrderBundle\Controller;

use A2\OrderBundle\Entity\Orders;
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
            ->findByIsActive(true)
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
            ->getRepository('A2SupplierBundle:Supplier')
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

        $order->setIsActive(false);

        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Commande supprimée');

        return $this->redirectToRoute('a2_corders_index');
    }
}