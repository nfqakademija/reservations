<?php

namespace Reservations\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservations")
 * @ORM\Entity
 */
class Reservations
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
     * @var Bar
     *
     * @ORM\ManyToOne(targetEntity="Reservations\CoreBundle\Entity\Bar", inversedBy="reservations")
     * @ORM\JoinColumn(name="bar_id", referencedColumnName="id")
     */
    private $barId;

    /**
     * @var integer
     *
     * @ORM\Column(name="people_amount", type="integer")
     */
    private $peopleAmount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="time")
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;


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
     * @return Reservation
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
     * Set peopleAmount
     *
     * @param integer $peopleAmount
     * @return Reservation
     */
    public function setPeopleAmount($peopleAmount)
    {
        $this->peopleAmount = $peopleAmount;

        return $this;
    }

    /**
     * Get peopleAmount
     *
     * @return integer 
     */
    public function getPeopleAmount()
    {
        return $this->peopleAmount;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Reservation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     * @return Reservation
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Reservation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Reservation
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Reservation
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }
}
