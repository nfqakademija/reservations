<?php

namespace Reservations\CoreBundle\Search;

use Doctrine\ORM\EntityManager;
use Reservations\CoreBundle\Entity\BarRepository;

class Bar
{
    private $entityManager;
    protected $repositoryName;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param mixed $repositoryName
     */
    public function setRepositoryName($repositoryName)
    {
        $this->repositoryName = $repositoryName;
    }

    /**
     * @param null|string $searchParameter
     * @return array
     */
    public function getBars($searchParameter = null)
    {
        $repository = $this->entityManager->getRepository($this->repositoryName);
        $bars = $repository->searchQuery($searchParameter);
        return $bars;
    }

    /**
     * @param $id
     * @return null|object
     */
    public function getBarInfoById($id)
    {
        $bar = $this->entityManager->getRepository($this->repositoryName)->find($id);
        return $bar;
    }
}
