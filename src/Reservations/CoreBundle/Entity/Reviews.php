<?php

namespace Reservations\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reviews
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Reviews
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="review", type="string", length=255)
     */
    private $review;

    /**
     * @var string
     *
     * @ORM\Column(name="rating", type="string", length=255)
     */
    private $rating;


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
     * @return Reviews
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
     * Set name
     *
     * @param string $name
     * @return Reviews
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
     * Set review
     *
     * @param string $review
     * @return Reviews
     */
    public function setReview($review)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return string 
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Set rating
     *
     * @param string $rating
     * @return Reviews
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return string 
     */
    public function getRating()
    {
        return $this->rating;
    }
}
