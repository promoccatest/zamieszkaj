<?php

namespace AppBundle\Controller;
//use AppBundle\Service\DateService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 2018-02-17
 * Time: 12:34
 */

class DefaultController extends Controller {
    /**
     * @Route("/", name="default_index")
     * @return Response
     */
    public function indexAction(){
        $entityManager = $this->getDoctrine()->getManager();
        $auctions = '';//$entityManager->getRepository(Auction::class)->findActiveOrdered();

//        $logger = $this->get('logger');
//        $logger->info("User wlazł na stronę index");
//
//        $logger->info("Dzien miesiaca (aktualny): ".$dateService->getDay(new \DateTime()));
        $content = [
            "title" => "Domyślny tytuł dla tekstu homepage",
            "body" => "Początek traktatu czasu być uważana. Dopiero możemy komu być uwieńczone; może być przypadłością."
        ];
        return $this->render("Default/index.html.twig", ["breadcrumb" => "Home", "content" => $content]);
    }

}