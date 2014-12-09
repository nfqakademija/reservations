<?php

namespace Reservations\FrontendBundle\Controller;

use FOS\UserBundle\Controller\ProfileController as BaseController;

class ProfileController extends BaseController
{
    /**
     * Show the user
     */
    public function showAction()
    {
        return $this->redirect($this->generateUrl('reservations_core_dashboard'));
    }
}
