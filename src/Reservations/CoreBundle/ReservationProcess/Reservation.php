<?php

namespace Reservations\CoreBundle\ReservationProcess;

use Doctrine\ORM\EntityManager;
use Reservations\CoreBundle\Entity\Reservations;

class Reservation
{
    private $entityManager;
    private $mailer;
    protected $repositoryName;

    /**
     * @param EntityManager $entityManager
     * @param Email         $mailer
     */
    public function __construct(EntityManager $entityManager, Email $mailer)
    {
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
    }

    /**
     * @param mixed $repositoryName
     */
    public function setRepositoryName($repositoryName)
    {
        $this->repositoryName = $repositoryName;
    }

    public function getReservationsByBarId($id)
    {
        $repository = $this->entityManager->getRepository($this->repositoryName);
        $reservations = $repository->find($id);
        return $reservations;
    }

    public function setReservation(Reservations $reservation, $id)
    {
        $reservation->setBarId($id);
        $reservation->setCode(rand(10000, 99999));

        $this->entityManager->persist($reservation);
        $this->entityManager->flush();

        $this->mailer->sendMail($reservation);
    }
}
