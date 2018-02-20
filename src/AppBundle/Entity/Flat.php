<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Flat
 *
 * @ORM\Table(name="flat")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FlatRepository")
 */
class Flat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank(
     *  message="Tytuł nie może być pusty"
     * )
     * @Assert\Length(
     *  min=3,
     *  max=255,
     *  minMessage="Minimalna długość to 3 znaki",
     *  maxMessage="Tytuł nie może być dłuższy niż 255 znaków"
     * )
     */
    private $title;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="offers")
     */
    private $owner;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank(
     *  message="Opis nie może być pusty"
     * )
     * @Assert\Length(
     *  min=10,
     *  minMessage="Opis nie może być krótszy jak 10 znaków"
     * )
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     * @Assert\NotBlank(
     * message="Cena nie może być pusta"
     * )
     * @Assert\GreaterThan(
     *  value="0",
     *  message="Cena musi być większa od 0"
     * )
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="area", type="integer")
     * @Assert\NotBlank(
     * message="Metraż mieszkania nie może być pusty"
     * )
     * @Assert\GreaterThan(
     *  value="0",
     *  message="Metraż mieszkania musi być większy od 0"
     * )
     */
    private $area;

    /**
     * @var int
     *
     * @ORM\Column(name="bedrooms", type="integer")
     * @Assert\NotBlank(
     * message="Liczba sypialni nie może być pusta"
     * )
     * @Assert\GreaterThan(
     *  value="0",
     *  message="Liczba sypialni musi być większa od 0"
     * )
     */
    private $bedrooms;

    /**
     * @var int
     *
     * @ORM\Column(name="bathrooms", type="integer")
     * @Assert\NotBlank(
     * message="Liczba łazienek nie może być pusta"
     * )
     */
    private $bathrooms;

    /**
     * @var int
     *
     * @ORM\Column(name="garages", type="integer")
     * @Assert\NotBlank(
     * message="Liczba garaży nie może być pusta"
     * )
     */
    private $garages;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiresAt", type="datetime")
     * @Assert\NotBlank(
     *  message="Data zakończenia musi być podana"
     * )
     * @Assert\GreaterThan(
     *  value="+1 day",
     *  message="Oferta wynajmu/kupna musi się kończyć najwcześniej za 24 godziny"
     * )
     */
    private $expiresAt;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Flat
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Flat
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Flat
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set area
     *
     * @param integer $area
     *
     * @return Flat
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return int
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set bedrooms
     *
     * @param integer $bedrooms
     *
     * @return Flat
     */
    public function setBedrooms($bedrooms)
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    /**
     * Get bedrooms
     *
     * @return int
     */
    public function getBedrooms()
    {
        return $this->bedrooms;
    }

    /**
     * Set bathrooms
     *
     * @param integer $bathrooms
     *
     * @return Flat
     */
    public function setBathrooms($bathrooms)
    {
        $this->bathrooms = $bathrooms;

        return $this;
    }

    /**
     * Get bathrooms
     *
     * @return int
     */
    public function getBathrooms()
    {
        return $this->bathrooms;
    }

    /**
     * Set garages
     *
     * @param integer $garages
     *
     * @return Flat
     */
    public function setGarages($garages)
    {
        $this->garages = $garages;

        return $this;
    }

    /**
     * Get garages
     *
     * @return int
     */
    public function getGarages()
    {
        return $this->garages;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Flat
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Flat
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set expiresAt
     *
     * @param \DateTime $expiresAt
     *
     * @return Flat
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * Get expiresAt
     *
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param User $owner
     * @return $this
     */
    public function setOwner(User $owner){
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return User
     */
    public function getOwner(){
        return $this->owner;
    }
}

