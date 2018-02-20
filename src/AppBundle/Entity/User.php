<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Flat[]\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Flat", mappedBy="owner")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $offers;

    /**
     * User constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->offers = new ArrayCollection();
    }

    /**
     * @return Flat[]|ArrayCollection
     */
    public function getFlats(){
        return $this->offers;
    }

    /**
     * @param Flat $offer
     * @return $this
     */
    public function addFlat(Flat $offer){
        $this->offers[] = $offer;

        return $this;
    }
}