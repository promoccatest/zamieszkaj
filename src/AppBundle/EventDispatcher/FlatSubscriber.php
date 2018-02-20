<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 2018-02-20
 * Time: 11:42
 */

namespace AppBundle\EventDispatcher;


use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FlatSubscriber implements EventSubscriberInterface {

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger){
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(){
        return [
            Events::FLAT_ADD => "log",
            Events::FLAT_EXPIRE => "logExpire"
        ];
    }

    public function log(FlatEvent $event){
        $flat = $event->getFlat();

        $this->logger->info("Mieszkanie {$flat->getId()} zostało dodane");
    }

    public function logExpire(AuctionEvent $event){
        $flat = $event->getFlat();

        $this->logger->info("Oferta mieszkania {$flat->getId()} została wycofana automatycznie");
    }
}