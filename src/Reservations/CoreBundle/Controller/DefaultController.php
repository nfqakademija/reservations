<?php

namespace Reservations\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ReservationsCoreBundle:Search:index.html.twig');
    }
}
