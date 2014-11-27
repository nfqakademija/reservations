<?php

namespace Reservations\CoreBundle\ReservationProcess;

use Reservations\CoreBundle\Entity\Reservations;

class Email
{
    private $mailer;
    private $twig;

    /**
     * @param \Swift_Mailer     $mailer
     * @param \Twig_Environment $twig
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
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
            ->setFrom('info.reservations.nfq@gmail.com')
            ->setTo($reservation->getEmail())
            ->setBody(
                $this->twig->render('ReservationsFrontendBundle:Mail:'.$way.'.html.twig', array(
                    'reservation' => $reservation
                )), 'text/html'
            )
        ;

        $this->mailer->send($message);
    }
}
