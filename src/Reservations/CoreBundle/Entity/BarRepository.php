<?php

namespace Reservations\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class BarRepository extends EntityRepository
{
    public function searchQuery($name)
    {
        return $this->getEntityManager()
            ->getRepository('ReservationsCoreBundle:Bar')
            ->createQueryBuilder('b')
            ->where('b.name LIKE :name')
            ->orWhere('b.address LIKE :name')
            ->orWhere('b.tags LIKE :name')
            ->setParameter('name', '%'.$name.'%')
            ->getQuery()
            ->getResult();
    }
}
