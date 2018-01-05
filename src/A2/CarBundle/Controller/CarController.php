<?php

namespace A2\CarBundle\Controller;

use A2\CarBundle\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Car controller.
 *
 */
class CarController extends Controller
{
    /**
     * Lists all car entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cars = $em
            ->getRepository('A2CarBundle:Car')
            ->findByIsActive(true)
        ;

        return $this->render('A2CarBundle:Car:index.html.twig', array(
            'cars' => $cars,
        ));
    }

    /**
     * Creates a new car entity.
     *
     */
    public function newAction(Request $request)
    {
        $car = new Car();
        $form = $this->createForm('A2\CarBundle\Form\CarType', $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $car->setAdminAdd($this->getUser()->getId());
            $car->setDateAdd(new \DateTime());
            $car->setIsActive(true);

            $em->persist($car);
            $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Voiture bien enregistrée');

            return $this->redirectToRoute('a2_car_show', array('id' => $car->getId()));
        }

        return $this->render('A2CarBundle:Car:new.html.twig', array(
            'car' => $car,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a car entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $car = $em
            ->getRepository('A2CarBundle:Car')
            ->myFind($id)
        ;

        if (null == $car)
            throw new NotFoundHttpException("La voiture d'id " .$id. " n'exiate pas");

        $nameAdminAdd = $em
            ->getRepository('A2CarBundle:Car')
            ->getAdminName($car, 'add')
        ;

        return $this->render('A2CarBundle:Car:show.html.twig', array(
            'car' => $car,
            'nameAdminAdd' => $nameAdminAdd
        ));
    }

    /**
     * Displays a form to edit an existing car entity.
     *
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $car = $em
            ->getRepository('A2CarBundle:Car')
            ->myFind($id)
        ;

        if (null == $car)
            throw new NotFoundHttpException("La voiture d'id " .$id. " n'existe pas");

        $editForm = $this->createForm('A2\CarBundle\Form\CarType', $car);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $car->setUserUpdate($this->getUser()->getId());
            $car->setDateUpdate(new \DateTime());

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Voiture bien modifiée');

            return $this->redirectToRoute('a2_car_edit', array('id' => $car->getId()));
        }

        return $this->render('A2CarBundle:Car:edit.html.twig', array(
            'car' => $car,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a car entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $car = $em
            ->getRepository('A2CarBundle:Car')
            ->myFind($id)
        ;

        if (null == $car)
            throw new NotFoundHttpException("La voiture d'id " .$id. " n'existe pas");

        $car->setIsActive(false);

        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Voiture supprimée');

        return $this->redirectToRoute('a2_car_index');
    }
}