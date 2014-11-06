<?php

namespace Reservations\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ReservationsFrontendBundle:Default:index.html.twig', array('name' => $name));
    }
}
