<?php

namespace Reservations\FrontendBundle\Controller;

use Reservations\FrontendBundle\Form\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Reservations\CoreBundle\Entity\Bars;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $bar = new Bars();
        $em = $this->getDoctrine()->getManager();
        $bars = $em->getRepository('ReservationsCoreBundle:Bars')->findAll();
        $form = $this->createForm(new SearchType(), $bar);
        return $this->render('ReservationsFrontendBundle:Default:index.html.twig', array(
            'bars' => $bars,
            'form' => $form->createView()
        ));
    }

    public function loginAction()
    {
        return $this->render('ReservationsFrontendBundle:Security:login.html.twig');
    }
}
