<?php

namespace Reservations\FrontendBundle\Controller;

use Reservations\FrontendBundle\Form\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Reservations\CoreBundle\Entity\Bar;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $bar = new Bar();
        $em = $this->getDoctrine()->getManager();
        $bars = $em->getRepository('ReservationsCoreBundle:Bar')->findAll();

        $form = $this->createForm(new SearchType(), $bar);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $search = $form->get('name')->getData();

            $repo = $em->getRepository('ReservationsCoreBundle:Bar');
            $query = $repo->createQueryBuilder('b')
                ->where('b.name LIKE :name')
                ->setParameter('name', '%'.$search.'%')
                ->getQuery();

            $bars = $query->getResult();
        }

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
