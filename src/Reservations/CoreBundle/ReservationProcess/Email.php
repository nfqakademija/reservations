<?php

namespace Reservations\CoreBundle\ReservationProcess;

use Reservations\CoreBundle\Entity\Reservations;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class Email
{
    private $mailer;
    private $container;

    /**
     * @param \Swift_Mailer $mailer
     * @param Container     $container
     */
    public function __construct(\Swift_Mailer $mailer, Container $container)
    {
        $this->mailer = $mailer;
        $this->container = $container;
    }

    /**
     * Send email
     * @param Reservations $reservation
     * @param              $subject
     * @param              $way
     */
    public function sendMail(Reservations $reservation, $subject, $way)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($this->container->getParameter('mailer_user'))
            ->setTo($reservation->getEmail())
            ->setBody(
                $this->container->get('twig')->render('ReservationsFrontendBundle:Mail:'.$way.'.html.twig', array(
                    'reservation' => $reservation
                )),
                'text/html'
            );

        $this->mailer->send($message);
    }

    public function sendRegistrationMail($subject, $sendTo)
    {
        $message = \Swift_Message::newInstance()
        ->setSubject($subject)
        ->setFrom($this->container->getParameter('mailer_user'))
        ->setTo($sendTo)
        ->setBody(
            $this->container->get('twig')->render('ReservationsFrontendBundle:Mail:registration.html.twig', array(
            )),
            'text/html'
        );

        $this->mailer->send($message);
    }
}
