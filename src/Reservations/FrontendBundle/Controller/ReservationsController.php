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
        return $this->render(
            'ReservationsFrontendBundle:Reservations:index.html.twig',
            $reservations->getReservations($this->getUser()->getBars()->getId())
        );
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

        return $this->render('ReservationsFrontendBundle:Reservations:'.$page.'.html.twig', array(
            'reservations' => $reservations->getReservationsByStatus($barId, $status)
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
        $reservation->changeStatus($id, $status);

        return $this->redirect($this->generateUrl('reservations_core_dashboard_reservations_page', array(
            'page' => 'waiting'
        )));
    }

    /**
     * Show form and process reservation
     * @param Request $request
     * @param         $barId
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function ajaxReservationAction(Request $request, $barId)
    {
        $bar = $this->get('reservations.core.search.bar')->getBarInfoById($barId);
        $reservations = $this->get('reservations.core.reservation_process.reservation');
        $reservationsBusyDays = $reservations->getReservationsByStatus($barId, 2);

        $reservation = new Reservations();
        $form = $this->createForm(new ReservationsType(), $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($request->isXmlHttpRequest()) {
                if ($form->isValid()) {
                    $reservations->setReservation($reservation, $bar);
                    return new JsonResponse(array('response' => true));
                } else {
                    return new JsonResponse(array('errors' => $this->getErrorMessages($form)));
                }
            }
        }

        return $this->render('ReservationsFrontendBundle:Form:form_reservation.html.twig', array(
            'bar' => $bar,
            'reservationsBusyDays' => $reservationsBusyDays,
            'form' => $form->createView()
        ));
    }

    private function getErrorMessages(\Symfony\Component\Form\FormInterface $form)
    {
        $errors = array();

        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getErrorMessages($child);
            }
        }

        return $errors;
    }
}
