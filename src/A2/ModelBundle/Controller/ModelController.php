<?php

namespace A2\ModelBundle\Controller;

use A2\ModelBundle\Entity\Model;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Model controller.
 *
 */
class ModelController extends Controller
{
    /**
     * Lists all model entities.
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
                $models = $em
                    ->getRepository('A2ModelBundle:Model')
                    ->findByKeyword($data['searchString'])
                ;

                return $this->render('A2ModelBundle:Model:index.html.twig', array(
                    'models' => $models,
                    'form' => $form->createView()
                ));
            }
        }

        $models = $em
            ->getRepository('A2ModelBundle:Model')
            ->findByIsActive(true)
        ;

        return $this->render('A2ModelBundle:Model:index.html.twig', array(
            'models' => $models,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a new model entity.
     *
     */
    public function newAction(Request $request)
    {
        $model = new Model();
        $form = $this->createForm('A2\ModelBundle\Form\ModelType', $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $model->setAdminAdd($this->getUser()->getId());
            $model->setDateAdd(new \DateTime());
            $model->setIsActive(true);

            $em->persist($model);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Modèle bien enregistré');

            return $this->redirectToRoute('a2_model_show', array('id' => $model->getId()));
        }

        return $this->render('A2ModelBundle:Model:new.html.twig', array(
            'model' => $model,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a model entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $model = $em
            ->getRepository('A2ModelBundle:Model')
            ->myFind($id)
        ;

        if (null == $model)
            throw new NotFoundHttpException("Le modèle d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2ModelBundle:Model')
            ->getAdminName($model, 'add')
        ;

        return $this->render('A2ModelBundle:Model:show.html.twig', array(
            'model' => $model,
            'nameAdminAdd' => $nameAdminAdd
        ));
    }

    /**
     * Displays a form to edit an existing model entity.
     *
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $model = $em
            ->getRepository('A2ModelBundle;Model')
            ->myFind($id)
        ;

        if (null == $model)
            throw new NotFoundHttpException("Le modèle d'id " .$id. " n'existe pas");

        $editForm = $this->createForm('A2\ModelBundle\Form\ModelType', $model);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $model->setUserUpdate($this->getUser()->getId());
            $model->setDateUpdate(new \DateTime());

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Modèle bien modifié');

            return $this->redirectToRoute('a2_model_edit', array('id' => $model->getId()));
        }

        return $this->render('A2ModelBundle:Model:edit.html.twig', array(
            'model' => $model,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a model entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $model = $em
            ->getRepository('A2ModelBundle:Model')
            ->myFind($id)
        ;

        if (null == $model)
            throw new NotFoundHttpException("Le modèle d'id " .$id. " n'existe pas");

        $model->setIsActive(false);

        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Modèle supprimé');

        return $this->redirectToRoute('a2_model_index');
    }
}