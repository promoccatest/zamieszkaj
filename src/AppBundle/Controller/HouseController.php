<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 2018-02-19
 * Time: 20:27
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HouseController extends Controller {
    /**
     * @Route("/domy", name="house_index")
     * @return Response
     */
    public function indexAction(){
        $content = [
            "title" => "Domyślny tytuł dla tekstu Domy",
            "body" => "Ażeby ojczyzna jak jogurt do czasu panowania Fryderyka Wielkiego, Króla Pruskiego."
        ];
        return $this->render("House/index.html.twig", ["breadcrumb" => "Domy", "content" => $content]);
    }
}