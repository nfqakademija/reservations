<?php

namespace Reservations\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Reservations\CoreBundle\Entity\Reservations;
use Reservations\FrontendBundle\Form\Type\ReservationsType;

class SearchController extends Controller
{
    /**
     * Display map with search form
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $search = $request->request->get('name');
        $bars = $this->get('reservations.core.search.bar')->getBars($search);
        return $this->render('ReservationsFrontendBundle:Search:index.html.twig', array(
            'bars' => $bars
        ));
    }

    /**
     * Show and process reservation
     * @param Request $request
     * @param         $id
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function ajaxReservationAction(Request $request, $id)
    {
        $bar = $this->get('reservations.core.search.bar')->getBarInfoById($id);
        $reservations = $this->get('reservations.core.reservation_process.reservation');
        $reservationsBusyDays = $reservations->getReservationsByBarId($id);

        $reservation = new Reservations();
        $form = $this->createForm(new ReservationsType(), $reservation);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $reservations->setReservation($reservation, $id);
            return new JsonResponse(array('response' => true));
        }

        return $this->render('ReservationsFrontendBundle:Form:form_reservation.html.twig', array(
            'bar' => $bar,
            'reservationsBusyDays' => $reservationsBusyDays,
            'form' => $form->createView()
        ));
    }

    public function loginAction()
    {
        return $this->render('ReservationsFrontendBundle:Security:login.html.twig');
    }
}
