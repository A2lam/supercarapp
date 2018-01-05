<?php

namespace A2\BrandBundle\Controller;

use A2\BrandBundle\Entity\Brand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Brand controller.
 *
 */
class BrandController extends Controller
{
    /**
     * Lists all brand entities.
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
                $brands = $em
                    ->getRepository('A2BrandBundle:Brand')
                    ->findByKeyword($data['searchString'])
                ;

                return $this->render('A2CategoryBundle:Category:index.html.twig', array(
                    'brands' => $brands,
                    'form' => $form->createView()
                ));
            }
        }

        $brands = $em
            ->getRepository('A2BrandBundle:Brand')
            ->findByIsActive(true)
        ;

        return $this->render('A2brandBundle:Brand:index.html.twig', array(
            'brands' => $brands,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a new brand entity.
     *
     */
    public function newAction(Request $request)
    {
        $brand = new Brand();
        $form = $this->createForm('A2\BrandBundle\Form\BrandType', $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $brand->setAdminAdd($this->getUser()->getId());
            $brand->setDateAdd(new \DateTime());
            $brand->setIsActive(true);

            $em->persist($brand);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Marque bien enregistrée');

            return $this->redirectToRoute('a2_brand_show', array('id' => $brand->getId()));
        }

        return $this->render('A2BrandBundle:Brand:new.html.twig', array(
            'brand' => $brand,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a brand entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        // On récupère l'entité lié à l'id $id
        $brand = $em
            ->getRepository('A2BrandBundle:Brand')
            ->myFind($id)
        ;

        if (null == $brand)
            throw new NotFoundHttpException("La marque d'id " .$id. " n'existe pas");

        $nameAdminAdd = $em
            ->getRepository('A2BrandBundle:Brand')
            ->getAdminName($brand, 'add')
        ;

        return $this->render('A2BrandBundle:Brand:show.html.twig', array(
            'brand' => $brand,
            'nameAdminAdd' => $nameAdminAdd
        ));
    }

    /**
     * Displays a form to edit an existing brand entity.
     *
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $brand = $em
            ->getRepository('A2BrandBundle:Brand')
            ->myFind($id)
        ;

        if (null == $brand)
            throw new NotFoundHttpException("La marque d'id " .$id. " n'existe pas");

        $editForm = $this->createForm('A2\BrandBundle\Form\BrandType', $brand);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $brand->setUserUpdate($this->getUser()->getId());
            $brand->setDateUpdate(new \DateTime());

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Marque bien modifiée');

            return $this->redirectToRoute('a2_brand_edit', array('id' => $brand->getId()));
        }

        return $this->render('A2BrandBundle:Brand:edit.html.twig', array(
            'brand' => $brand,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a brand entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $brand = $em
            ->getRepository('A2CategoryBundle:Category')
            ->myFind($id)
        ;

        if (null == $brand)
            throw new NotFoundHttpException("La marque d'id " .$id. " n'existe pas");

        $brand->setIsActive(false);

        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Marque supprimée');

        return $this->redirectToRoute('a2_brand_index');
    }
}