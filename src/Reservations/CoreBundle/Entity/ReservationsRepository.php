<?php

namespace Reservations\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ReservationsRepository extends EntityRepository
{
    /**
     * @param $status
     * @return mixed
     */
    public function countByStatus($status)
    {
        return $this->getEntityManager()
            ->getRepository('ReservationsCoreBundle:Reservations')
            ->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->where('r.status = :status')
            ->setParameter('status', $status)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
