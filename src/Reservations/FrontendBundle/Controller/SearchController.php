<?php

namespace Reservations\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
        $session = $this->get('session');
        $session->set('value', $search);
        $bars = $this->get('reservations.core.search.bar')->getBars($search);
        return $this->render('ReservationsFrontendBundle:Search:index.html.twig', array(
            'bars' => $bars,
            'value' => $session->get('value')
        ));
    }

    /**
     * Show bat info page
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $bar = $this->get('reservations.core.search.bar')->getBarInfoById($id);
        return $this->render('ReservationsFrontendBundle:Bar:show.html.twig', array(
            'bar' => $bar
        ));
    }
}
