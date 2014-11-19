<?php

namespace Reservations\FrontendBundle\Service;

class SendMailService
{
    protected $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Send generated code to customer
     * @param $to
     * @param $code
     */
    public function sendMail($to, $code)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('send@example.com')
            ->setTo($to)
            ->setBody('translate file: '.$code)
        ;

        $this->mailer->send($message);
    }
}
