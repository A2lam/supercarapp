<?php

namespace A2\CurrencyBundle\Controller;

use A2\CurrencyBundle\Entity\Currency;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Currency controller.
 *
 */
class CurrencyController extends Controller
{
    /**
     * Lists all currency entities.
     * @Security("has_role('ROLE_MANAGER')")
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
                $currencies = $em
                    ->getRepository('A2CurrencyBundle:Currency')
                    ->findByKeyword($data['searchString'])
                ;

                return $this->render('A2CurrencyBundle:Currency:index.html.twig', array(
                    'currencies' => $currencies,
                    'form' => $form->createView()
                ));
            }
        }

        $currencies = $em
            ->getRepository('A2CurrencyBundle:Currency')
            ->findBy(
                array('isActive' => true),
                array('dateAdd'  => 'DESC')
            )
        ;

        return $this->render('A2CurrencyBundle:Currency:index.html.twig', array(
            'currencies' => $currencies,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a new currency entity.
     * @Security("has_role('ROLE_MANAGER')")
     */
    public function newAction(Request $request)
    {
        $currency = new Currency();
        $form = $this->createForm('A2\CurrencyBundle\Form\CurrencyType', $currency);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $currency->setAdminAdd($this->getUser()->getId());
            $currency->setDateAdd(new \DateTime());
            $currency->setIsActive(true);

            $em->persist($currency);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Devise bien enregistrée');

            return $this->redirectToRoute('a2_currency_show', array('id' => $currency->getId()));
        }

        return $this->render('A2CurrencyBundle:Currency:new.html.twig', array(
            'currency' => $currency,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a currency entity.
     * @Security("has_role('ROLE_MANAGER')")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $currency = $em
            ->getRepository('A2CurrencyBundle:Currency')
            ->myFind($id)
        ;

        if (null == $currency)
            throw new NotFoundHttpException("La devise d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2CurrencyBundle:Currency')
            ->getAdminName($currency, 'add')
        ;

        $nameUserUpdate = $em
            ->getRepository('A2CurrencyBundle:Currency')
            ->getAdminName($currency, 'update')
        ;

        return $this->render('A2CurrencyBundle:Currency:show.html.twig', array(
            'currency' => $currency,
            'nameAdminAdd' => $nameAdminAdd,
            'nameUserUpdate' => $nameUserUpdate
        ));
    }

    /**
     * Displays a form to edit an existing currency entity.
     * @Security("has_role('ROLE_MANAGER')")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $currency = $em
            ->getRepository('A2CurrencyBundle:Currency')
            ->myFind($id)
        ;

        if (null == $currency)
            throw new NotFoundHttpException("La devise d'id " .$id. " n'existe pas");

        $editForm = $this->createForm('A2\CurrencyBundle\Form\CurrencyType', $currency);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $currency->setUserUpdate($this->getUser()->getId());
            $currency->setDateUpdate(new \DateTime());

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Devise bien modifiée');

            return $this->redirectToRoute('a2_currency_show', array('id' => $currency->getId()));
        }

        return $this->render('A2CurrencyBundle:Currency:edit.html.twig', array(
            'currency' => $currency,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a currency entity.
     * @Security("has_role('ROLE_MANAGER')")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $currency = $em
            ->getRepository('A2CurrencyBundle:Currency')
            ->myFind($id)
        ;

        if (null == $currency)
            throw new NotFoundHttpException("La devise d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2CurrencyBundle:Currency')
            ->getAdminName($currency, 'add')
        ;

        $nameUserUpdate = $em
            ->getRepository('A2CurrencyBundle:Currency')
            ->getAdminName($currency, 'update')
        ;

        $deleteForm = $this->createFormBuilder()->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $currency->setIsActive(false);

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Devise supprimée');

            return $this->redirectToRoute('a2_currency_index');
        }

        return $this->render('A2CurrencyBundle:Currency:delete.html.twig', array(
            'currency'     =>      $currency,
            'nameAdminAdd' =>   $nameAdminAdd,
            'nameUserUpdate' => $nameUserUpdate,
            'delete_form' =>    $deleteForm->createView()
        ));
    }
}