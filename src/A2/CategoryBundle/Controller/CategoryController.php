<?php

namespace A2\CategoryBundle\Controller;

use A2\CategoryBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Category controller.
 *
 */
class CategoryController extends Controller
{
    /**
     * Lists all category entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em
            ->getRepository('A2CategoryBundle:Category')
            ->findByIsActive(true)
        ;

        return $this->render('A2CategoryBundle:Category:index.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * Creates a new category entity.
     *
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

            return $this->redirectToRoute('a2_category_show', array('id' => $category->getId()));
        }

        return $this->render('A2CategoryBundle:Category:new.html.twig', array(
            'category' => $category,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a category entity.
     *
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

        return $this->render('A2CategoryBundle:Category:show.html.twig', array(
            'category'     => $category,
            'nameAdminAdd' => $nameAdminAdd
        ));
    }

    /**
     * Displays a form to edit an existing category entity.
     *
     */
    public function editAction(Request $request, Category $category)
    {
        $deleteForm = $this->createDeleteForm($category);
        $editForm = $this->createForm('A2\CategoryBundle\Form\CategoryType', $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_edit', array('id' => $category->getId()));
        }

        return $this->render('category/edit.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a category entity.
     *
     */
    public function deleteAction(Request $request, Category $category)
    {
        $form = $this->createDeleteForm($category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();
        }

        return $this->redirectToRoute('category_index');
    }

    /**
     * Creates a form to delete a category entity.
     *
     * @param Category $category The category entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Category $category)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('category_delete', array('id' => $category->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}