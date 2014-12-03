<?php

namespace Reservations\CoreBundle\ReservationProcess;

use Doctrine\ORM\EntityManager;
use Reservations\CoreBundle\Entity\Reservations;
use Reservations\CoreBundle\Entity\Bar;

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
     * @param $barId
     * @param $status
     * @return array
     */
    public function getReservationsByStatus($barId, $status)
    {
        $repository = $this->entityManager->getRepository($this->repositoryName);
        $waiting = $repository->findBy(array(
            'barId' => $barId,
            'status' => $status
        ));
        return $waiting;
    }

    /**
     * Get reservations count by status
     * @param $status
     * @return mixed
     */
    public function getReservationsCount($status, $barId)
    {
        $repository = $this->entityManager->getRepository($this->repositoryName);
        return $repository->countByStatus($status, $barId);
    }

    /**
     * Set new reservation and send email
     * @param Reservations $reservation
     * @param Bar          $bar
     */
    public function setReservation(Reservations $reservation, Bar $bar)
    {
        $reservation->setBarId($bar);
        $reservation->setCode($this->uniqueRand());

        $this->entityManager->persist($reservation);
        $this->entityManager->flush();

        $this->mailer->sendMail($reservation, 'Rezervacija', 'new_reservation');
    }

    /**
     * Set status reservation
     * @param $id
     * @param $status
     */
    public function setStatus($id, $status)
    {
        $reservation = $this->entityManager->getRepository($this->repositoryName)->find($id);
        $reservation->setStatus($status);
        $this->entityManager->flush();
        if ($status === 2) {
            $this->mailer->sendMail($reservation, 'Rezervacijos patvirtinimas', 'confirm_reservation');
        } elseif ($status === 1) {
            $this->mailer->sendMail($reservation, 'Rezervacijos atšaukimas', 'cancel_reservation');
        }
    }

    /**
     * @param $string
     * @return int
     */
    public function getStatusByName($string)
    {
        if ($string === 'waiting') {
            return 0;
        } elseif ($string === 'cancel') {
            return 1;
        } elseif ($string === 'confirmed') {
            return 2;
        }
    }

    /**
     * Generate random string
     * @return string
     */
    private function uniqueRand()
    {
        $rand = uniqid();
        $rand = strrev($rand);
        $rand = substr($rand, 0, 9);
        return $rand;
    }
}
