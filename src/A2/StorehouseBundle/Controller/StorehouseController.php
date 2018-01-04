<?php

namespace A2\StorehouseBundle\Controller;

use A2\StorehouseBundle\Entity\Storehouse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Storehouse controller.
 *
 */
class StorehouseController extends Controller
{
    /**
     * Lists all storehouse entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $storehouses = $em
            ->getRepository('A2StorehouseBundle:Storehouse')
            ->findByIsActive(true)
        ;

        return $this->render('A2StorehouseBundle:Storehouse:index.html.twig', array(
            'storehouses' => $storehouses,
        ));
    }

    /**
     * Creates a new storehouse entity.
     *
     */
    public function newAction(Request $request)
    {
        $storehouse = new Storehouse();
        $form = $this->createForm('A2\StorehouseBundle\Form\StorehouseType', $storehouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $storehouse->setAdminAdd($this->getUser()->getId());
            $storehouse->setDateAdd(new \DateTime());
            $storehouse->setIsActive(true);

            $em->persist($storehouse);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Entrepot bien enregistré');

            return $this->redirectToRoute('a2_storehouse_show', array('id' => $storehouse->getId()));
        }

        return $this->render('A2StorehouseBundle:Storehouse:new.html.twig', array(
            'storehouse' => $storehouse,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a storehouse entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $storehouse = $em
            ->getRepository('A2StorehouseBundle:Storehouse')
            ->myFind($id)
        ;

        if (null == $storehouse)
            throw new NotFoundHttpException("L'entrepôt d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2StorehouseBundle:Storehouse')
            ->getAdminName($storehouse, 'add')
        ;

        return $this->render('A2StorehouseBundle:Storehouse:show.html.twig', array(
            'storehouse' => $storehouse,
            'nameAdminAdd' => $nameAdminAdd
        ));
    }

    /**
     * Displays a form to edit an existing storehouse entity.
     *
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $storehouse = $em
            ->getRepository('A2StorehouseBundle:Storehouse')
            ->myFind($id)
        ;

        if (null == $storehouse)
            throw new NotFoundHttpException("L'entrepôt d'id " .$id. " n'existe pas");

        $editForm = $this->createForm('A2\StorehouseBundle\Form\StorehouseType', $storehouse);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $storehouse->setUserUpdate($this->getUser()->getId());
            $storehouse->setDateUpdate(new \DateTime());

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Entrepôt bien modifié');

            return $this->redirectToRoute('a2_storehouse_edit', array('id' => $storehouse->getId()));
        }

        return $this->render('A2StorehouseBundle:Storehouse:edit.html.twig', array(
            'storehouse' => $storehouse,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a storehouse entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $storehouse = $em
            ->getRepository('A2StorehouseBundle:Storehouse')
            ->myFind($id)
        ;

        if (null == $storehouse)
            throw new NotFoundHttpException("L'entrepôt d'id " .$id. " n'existe pas");

        $storehouse->setIsActive(false);

        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Entrepôt supprimé');

        return $this->redirectToRoute('a2_storehouse_index');
    }
}