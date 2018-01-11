<?php

namespace A2\UserBundle\Controller;

use A2\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
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
                $users = $em
                    ->getRepository('A2UserBundle:User')
                    ->findByKeyword($data['searchString'])
                ;

                return $this->render('A2UserBundle:User:index.html.twig', array(
                    'users' => $users,
                    'form' => $form->createView()
                ));
            }
        }

        $users = $em
            ->getRepository('A2UserBundle:User')
            ->findBy(
                array('isActive' => true),
                array('dateAdd'  => 'DESC')
            )
        ;

        return $this->render('A2UserBundle:User:index.html.twig', array(
            'users' => $users,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a new user entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('A2\UserBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }

        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em
            ->getRepository('A2UserBundle:User')
            ->myFind($id)
        ;

        if (null == $user)
            throw new NotFoundHttpException("L'utilisateur d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2UserBundle:User')
            ->getAdminName($user, 'add')
        ;

        $nameUserUpdate = $em
            ->getRepository('A2UserBundle:User')
            ->getAdminName($user, 'update')
        ;

        return $this->render('A2UserBundle:User:show.html.twig', array(
            'user' => $user,
            'nameAdminAdd' => $nameAdminAdd,
            'nameUserUpdate' => $nameUserUpdate
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     */
    public function editAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('A2\UserBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em
            ->getRepository('A2UserBundle:User')
            ->myFind($id)
        ;

        if (null == $user)
            throw new NotFoundHttpException("L'utilisateur d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2UserBundle:User')
            ->getAdminName($user, 'add')
        ;

        $nameUserUpdate = $em
            ->getRepository('A2UserBundle:User')
            ->getAdminName($user, 'update')
        ;

        $deleteForm = $this->createFormBuilder()->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $user->setIsActive(false);

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Utilisateur supprimé');

            return $this->redirectToRoute('a2_user_index');
        }

        return $this->render('A2SupplierBundle:Supplier:delete.html.twig', array(
            'user'     => $user,
            'nameAdminAdd'   => $nameAdminAdd,
            'nameUserUpdate' => $nameUserUpdate,
            'delete_form'    => $deleteForm->createView()
        ));
    }
}