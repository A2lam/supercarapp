<?php

namespace A2\CategoryBundle\Controller;

use A2\CategoryBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Category controller.
 *
 */
class CategoryController extends Controller
{
    /**
     * Lists all category entities.
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
                $categories = $em
                    ->getRepository('A2CategoryBundle:Category')
                    ->findByKeyword($data['searchString'])
                ;

                return $this->render('A2CategoryBundle:Category:index.html.twig', array(
                    'categories' => $categories,
                    'form' => $form->createView()
                ));
            }
        }

        $categories = $em
            ->getRepository('A2CategoryBundle:Category')
            ->findBy(
                array('isActive' => true),
                array('dateAdd'  => 'DESC')
            )
        ;

        return $this->render('A2CategoryBundle:Category:index.html.twig', array(
            'categories' => $categories,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a new category entity.
     * @Security("has_role('ROLE_MANAGER')")
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm('A2\CategoryBundle\Form\CategoryType', $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $category->setAdminAdd($this->getUser()->getId());
            $category->setDateAdd(new \DateTime());
            $category->setIsActive(true);

            $em->persist($category);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Catégorie bien enregistrée');

            return $this->redirectToRoute('a2_category_show', array('id' => $category->getId()));
        }

        return $this->render('A2CategoryBundle:Category:new.html.twig', array(
            'category' => $category,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a category entity.
     * @Security("has_role('ROLE_MANAGER')")
     */
    public function showAction($id)
    {
        // On récupère l'entity manager
        $em = $this->getDoctrine()->getManager();

        // On récupère maintenant l'entité correspondant à l'id $id
        $category = $em
            ->getRepository('A2CategoryBundle:Category')
            ->myFind($id)
        ;

        if (null == $category)
            throw new NotFoundHttpException("La catégorie d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2CategoryBundle:Category')
            ->getAdminName($category, 'add')
        ;

        $nameUserUpdate = $em
            ->getRepository('A2CategoryBundle:Category')
            ->getAdminName($category, 'update')
        ;

        return $this->render('A2CategoryBundle:Category:show.html.twig', array(
            'category'     => $category,
            'nameAdminAdd' => $nameAdminAdd,
            'nameUserUpdate' => $nameUserUpdate
        ));
    }

    /**
     * Displays a form to edit an existing category entity.
     * @Security("has_role('ROLE_MANAGER')")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em
            ->getRepository('A2CategoryBundle:Category')
            ->myFind($id)
        ;

        if (null == $category)
            throw new NotFoundHttpException("La catégorie d'id " .$id. " n'existe pas");

        $editForm = $this->createForm('A2\CategoryBundle\Form\CategoryType', $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $category->setUserUpdate($this->getUser()->getId());
            $category->setDateUpdate(new \DateTime());

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Catégorie bien modifiée');

            return $this->redirectToRoute('a2_category_show', array('id' => $category->getId()));
        }

        return $this->render('A2CategoryBundle:Category:edit.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a category entity.
     * @Security("has_role('ROLE_MANAGER')")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em
            ->getRepository('A2CategoryBundle:Category')
            ->myFind($id)
        ;

        if (null == $category)
            throw new NotFoundHttpException("La catégorie d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2CategoryBundle:Category')
            ->getAdminName($category, 'add')
        ;

        $nameUserUpdate = $em
            ->getRepository('A2CategoryBundle:Category')
            ->getAdminName($category, 'update')
        ;

        $deleteForm = $this->createFormBuilder()->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $category->setIsActive(false);

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Catégorie supprimée');

            return $this->redirectToRoute('a2_category_index');
        }

        return $this->render('A2CategoryBundle:Category:delete.html.twig', array(
            'category'     => $category,
            'nameAdminAdd' => $nameAdminAdd,
            'nameUserUpdate' => $nameUserUpdate,
            'delete_form' => $deleteForm->createView()
        ));
    }
}