<?php

namespace Reservations\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ReservationsFrontendBundle:Default:index.html.twig');
    }

    public function loginAction()
    {
      return $this->render('ReservationsFrontendBundle:Security:login.html.twig');
    }
}
