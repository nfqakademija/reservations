<?php

namespace Reservations\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Reservations\CoreBundle\Entity\Reservations;
use Reservations\FrontendBundle\Form\Type\ReservationsType;

class ReservationsController extends Controller
{

    /**
     * Show dashboard
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $reservations = $this->get('reservations.core.reservation_process.reservation');
        if (!$this->getUser()->getBars()) {
            return $this->redirect($this->generateUrl('bar_new'));
        }
        $barId = $this->getUser()->getBars()->getId();
        return $this->render('ReservationsFrontendBundle:Reservations:index.html.twig', array(
            'waiting' => $reservations->getReservationsCount(0, $barId),
            'confirmed' => $reservations->getReservationsCount(2, $barId),
            'cancel' => $reservations->getReservationsCount(1, $barId)
        ));
    }

    /**
     * Show reservations
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function reservationsAction($page)
    {
        $reservations = $this->get('reservations.core.reservation_process.reservation');
        if (!$this->getUser()->getBars()) {
            return $this->redirect($this->generateUrl('bar_new'));
        }
        $barId = $this->getUser()->getBars()->getId();
        $status = $reservations->getStatusByName($page);
        $getReservations = $reservations->getReservationsByStatus($barId, $status);

        return $this->render('ReservationsFrontendBundle:Reservations:'.$page.'.html.twig', array(
            'reservations' => $getReservations
        ));
    }

    /**
     * @param $id
     * @param $status
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function changeStatusAction($id, $status)
    {
        $reservation = $this->get('reservations.core.reservation_process.reservation');
        if ($status == 'accept') {
            $reservation->setStatus($id, 2);
        } elseif ($status == 'cancel') {
            $reservation->setStatus($id, 1);
        }
        return $this->redirect($this->generateUrl('reservations_core_dashboard_reservations_page', array(
            'page' => 'waiting'
        )));
    }

    /**
     * Show form and process reservation
     * @param Request $request
     * @param         $id
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function ajaxReservationAction(Request $request, $id)
    {
        $bar = $this->get('reservations.core.search.bar')->getBarInfoById($id);
        $reservations = $this->get('reservations.core.reservation_process.reservation');
        $reservationsBusyDays = $reservations->getReservationsByStatus($id, 2);

        $reservation = new Reservations();
        $form = $this->createForm(new ReservationsType(), $reservation);
        $form->handleRequest($request);

        if ($form->isValid()) {
            //if ($request->isXmlHttpRequest()) {
                $reservations->setReservation($reservation, $bar);
                return new JsonResponse(array('response' => true));
            //}
        } /*else {
            if ($request->isXmlHttpRequest()) {
                return new JsonResponse(array('errors' => $form->getErrors()));
            }
        }*/

        return $this->render('ReservationsFrontendBundle:Form:form_reservation.html.twig', array(
            'bar' => $bar,
            'reservationsBusyDays' => $reservationsBusyDays,
            'form' => $form->createView()
        ));
    }
}
