<?php

namespace Reservations\FrontendBundle\Controller;

use Reservations\CoreBundle\Entity\Reservations;
use Reservations\FrontendBundle\Form\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Reservations\CoreBundle\Entity\Bar;
use Reservations\FrontendBundle\Form\Type\ReservationsType;

class DefaultController extends Controller
{
    /**
     * Display map with search form
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $bars = $em->getRepository('ReservationsCoreBundle:Bar')->findAll();

        $form = $this->createForm(new SearchType(), new Bar());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $search = $form->get('name')->getData();
            $bars = $em->getRepository('ReservationsCoreBundle:Bar')->searchQuery($search);
        }

        return $this->render('ReservationsFrontendBundle:Default:index.html.twig', array(
            'bars' => $bars,
            'form' => $form->createView()
        ));
    }

    public function showAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $bar = $em->getRepository('ReservationsCoreBundle:Bar')->find($id);
        $reservations = $em->getRepository('ReservationsCoreBundle:Reservations')->findByBarId($bar->getId());

        if (!$bar) {
            throw $this->createNotFoundException('No advert');
        }

        $reservation = new Reservations();
        $reservation->setBarId($id);
        $reservation->setCode(rand(1000, 9999));

        $form = $this->createForm(new ReservationsType(), $reservation);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($reservation);
            $em->flush();

            $this->get('reservations.frontend.mail.send')->sendMail(
                $reservation->getEmail(),
                $reservation->getCode()
            );

            return $this->redirect($this->generateUrl('reservations_core_homepage'));
        }

        return $this->render('ReservationsFrontendBundle:Default:show.html.twig', array(
            'bar' => $bar,
            'reservations' => $reservations,
            'form' => $form->createView()
        ));
    }

    public function loginAction()
    {
        return $this->render('ReservationsFrontendBundle:Security:login.html.twig');
    }
}
