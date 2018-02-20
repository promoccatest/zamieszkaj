<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 2018-02-20
 * Time: 11:40
 */

namespace AppBundle\EventDispatcher;

use AppBundle\Entity\Flat;
use Symfony\Component\EventDispatcher\Event;

class FlatEvent extends Event {
    /**
     * @var Flat
     */
    private $flat;

    public function __construct(Flat $flat){
        $this->flat = $flat;
    }

    /**
     * @return Flat
     */
    public function getFlat(){
        return $this->flat;
    }
}