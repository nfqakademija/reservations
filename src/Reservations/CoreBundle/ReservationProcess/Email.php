<?php

namespace Reservations\CoreBundle\ReservationProcess;

use Reservations\CoreBundle\Entity\Reservations;

class Email
{
    private $mailer;
    private $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * Send email
     * @param Reservations $reservation
     */
    public function sendMail(Reservations $reservation)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('send@example.com')
            ->setTo($reservation->getEmail())
            ->setBody(
                $this->twig->render('ReservationsFrontendBundle:Mail:send.html.twig', array(
                    'code' => $reservation->getCode(),
                    'name' => $reservation->getName(),
                ))
            )
        ;

        $this->mailer->send($message);
    }
}
