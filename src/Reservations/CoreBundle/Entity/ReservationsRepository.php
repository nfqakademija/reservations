<?php

namespace Reservations\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ReservationsRepository extends EntityRepository
{
    /**
     * @param $status
     * @param $barId
     * @return mixed
     */
    public function countByStatus($status, $barId)
    {
        return $this->getEntityManager()
            ->getRepository('ReservationsCoreBundle:Reservations')
            ->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->where('r.status = :status')
            ->andWhere('r.barId = :barId')
            ->setParameter('status', $status)
            ->setParameter('barId', $barId)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
