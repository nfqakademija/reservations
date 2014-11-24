<?php

namespace Reservations\CoreBundle\ReservationProcess;

use Doctrine\ORM\EntityManager;
use Reservations\CoreBundle\Entity\Reservations;

class Reservation
{
    private $entityManager;
    private $mailer;
    private $repositoryName;

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

    /**
     * Get reservations by bar id
     * @param $id
     * @return null|object
     */
    public function getReservationsByBarId($id)
    {
        $repository = $this->entityManager->getRepository($this->repositoryName);
        $reservations = $repository->find($id);
        return $reservations;
    }

    /**
     * Set new reservation and send email
     * @param Reservations $reservation
     * @param              $id
     */
    public function setReservation(Reservations $reservation, $id)
    {
        $reservation->setBarId($id);
        $reservation->setCode(rand(10000, 99999));

        $this->entityManager->persist($reservation);
        $this->entityManager->flush();

        $this->mailer->sendMail($reservation);
    }
}
