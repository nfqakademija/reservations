<?php

namespace Reservations\FrontendBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends BaseController
{

    public function registerAction(Request $request)
    {
        $return = parent::registerAction($request);
        if ($this->getUser()) {
            $this->get('reservations.core.reservation_process.email')
                ->sendRegistrationMail("Nauja registracija.", $this->getUser()->getEmail());

        }
        return $return;
    }
}
