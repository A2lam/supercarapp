<?php
/**
 * Created by PhpStorm.
 * User: Allam
 * Date: 22/12/2017
 * Time: 19:21
 */

namespace A2\UserBundle\Controller;

use A2\AddressBundle\Entity\Address;
use A2\StorehouseBundle\Entity\Storehouse;
use A2\UserBundle\Entity\Admin;
use A2\UserBundle\Entity\Manager;
use A2\UserBundle\Entity\Seller;
use A2\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use FOS\UserBundle\Event\GetResponseUserEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @return null|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function registerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = new User();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $this->createForm('A2\UserBundle\Form\UserType');
        $form->setData($user);

        $roleForm = $this->createForm('A2\UserBundle\Form\UserroleType', null);

        $form->handleRequest($request);
        $roleForm->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                $user->setAdminAdd(1);
                $user->setDateAdd(new \DateTime());
                $user->setIsActive(true);

                if ($roleForm->get('role')->getData() == 1)
                {
                    $user->setRoles(array('ROLE_ADMIN'));

                    $admin = new Admin();
                    $admin->setUser($user);

                    $em->persist($admin);

                    if (null == $admin->getUser()->getImage()->getAlt())
                    {
                        $em->detach($admin->getUser()->getImage());
                    }
                }
                elseif ($roleForm->get('role')->getData() == 2)
                {
                    $user->setRoles(array('ROLE_MANAGER'));

                    $manager = new Manager();
                    $manager->setUser($user);

                    $em->persist($manager);

                    if (null == $manager->getUser()->getImage()->getAlt())
                    {
                        $em->detach($manager->getUser()->getImage());
                    }
                }
                else
                {
                    $user->setRoles(array('ROLE_MANAGER'));

                    $seller = new Seller();
                    $seller->setNbSales(0);
                    $seller->setUser($user);

                    $em->persist($seller);

                    if (null == $seller->getUser()->getImage()->getAlt())
                    {
                        $em->detach($seller->getUser()->getImage());
                    }
                }

                $em->flush();

                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }

        return $this->render('@FOSUser/Registration/register.html.twig', array(
            'form'      => $form->createView(),
            'role_form' => $roleForm->createView()
        ));
    }
}