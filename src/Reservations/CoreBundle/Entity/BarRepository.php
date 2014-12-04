<?php

namespace Reservations\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class BarRepository extends EntityRepository
{
    /**
     * Search bars by name, address, tags
     * @param $search
     * @return array
     */
    public function searchQuery($search)
    {
        return $this->getEntityManager()
            ->getRepository('ReservationsCoreBundle:Bar')
            ->createQueryBuilder('b')
            ->where('b.name LIKE :search')
            ->orWhere('b.address LIKE :search')
            ->orWhere('b.tags LIKE :search')
            ->andWhere('b.status = 1')
            ->setParameter('search', '%'.$search.'%')
            ->getQuery()
            ->getResult();
    }
}
