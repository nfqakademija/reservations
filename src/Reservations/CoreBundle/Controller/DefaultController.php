<?php

namespace Reservations\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ReservationsCoreBundle:Default:index.html.twig', array('name' => $name));
    }
}
