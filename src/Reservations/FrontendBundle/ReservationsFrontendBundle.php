<?php

namespace Reservations\FrontendBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ReservationsFrontendBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
