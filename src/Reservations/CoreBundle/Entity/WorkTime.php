<?php

namespace Reservations\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WorkTime
 *
 * @ORM\Table(name="work_time")
 * @ORM\Entity
 */
class WorkTime
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="bar_id", type="integer")
     */
    private $barId;

    /**
     * @var string
     *
     * @ORM\Column(name="monday", type="string", length=255)
     */
    private $monday;

    /**
     * @var string
     *
     * @ORM\Column(name="tuesday", type="string", length=255)
     */
    private $tuesday;

    /**
     * @var string
     *
     * @ORM\Column(name="wednesday", type="string", length=255)
     */
    private $wednesday;

    /**
     * @var string
     *
     * @ORM\Column(name="thursday", type="string", length=255)
     */
    private $thursday;

    /**
     * @var string
     *
     * @ORM\Column(name="friday", type="string", length=255)
     */
    private $friday;

    /**
     * @var string
     *
     * @ORM\Column(name="saturday", type="string", length=255)
     */
    private $saturday;

    /**
     * @var string
     *
     * @ORM\Column(name="sunday", type="string", length=255)
     */
    private $sunday;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set barId
     *
     * @param integer $barId
     * @return WorkTime
     */
    public function setBarId($barId)
    {
        $this->barId = $barId;

        return $this;
    }

    /**
     * Get barId
     *
     * @return integer 
     */
    public function getBarId()
    {
        return $this->barId;
    }

    /**
     * Set monday
     *
     * @param string $monday
     * @return WorkTime
     */
    public function setMonday($monday)
    {
        $this->monday = $monday;

        return $this;
    }

    /**
     * Get monday
     *
     * @return string 
     */
    public function getMonday()
    {
        return $this->monday;
    }

    /**
     * Set tuesday
     *
     * @param string $tuesday
     * @return WorkTime
     */
    public function setTuesday($tuesday)
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    /**
     * Get tuesday
     *
     * @return string 
     */
    public function getTuesday()
    {
        return $this->tuesday;
    }

    /**
     * Set wednesday
     *
     * @param string $wednesday
     * @return WorkTime
     */
    public function setWednesday($wednesday)
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    /**
     * Get wednesday
     *
     * @return string 
     */
    public function getWednesday()
    {
        return $this->wednesday;
    }

    /**
     * Set thursday
     *
     * @param string $thursday
     * @return WorkTime
     */
    public function setThursday($thursday)
    {
        $this->thursday = $thursday;

        return $this;
    }

    /**
     * Get thursday
     *
     * @return string 
     */
    public function getThursday()
    {
        return $this->thursday;
    }

    /**
     * Set friday
     *
     * @param string $friday
     * @return WorkTime
     */
    public function setFriday($friday)
    {
        $this->friday = $friday;

        return $this;
    }

    /**
     * Get friday
     *
     * @return string 
     */
    public function getFriday()
    {
        return $this->friday;
    }

    /**
     * Set saturday
     *
     * @param string $saturday
     * @return WorkTime
     */
    public function setSaturday($saturday)
    {
        $this->saturday = $saturday;

        return $this;
    }

    /**
     * Get saturday
     *
     * @return string 
     */
    public function getSaturday()
    {
        return $this->saturday;
    }

    /**
     * Set sunday
     *
     * @param string $sunday
     * @return WorkTime
     */
    public function setSunday($sunday)
    {
        $this->sunday = $sunday;

        return $this;
    }

    /**
     * Get sunday
     *
     * @return string 
     */
    public function getSunday()
    {
        return $this->sunday;
    }
}
