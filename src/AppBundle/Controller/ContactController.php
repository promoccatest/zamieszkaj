<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 2018-02-19
 * Time: 20:28
 */

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ContactController extends Controller {
    /**
     * @Route("/kontakt", name="contact_index")
     * @return Response
     */
    public function indexAction(){
        $content = [
            "title" => "Domyślny tytuł dla tekstu Kontakt",
            "body" => "Bylebyś do niczego jako czasu panowania Fryderyka Wielkiego, Króla Pruskiego."
        ];
        return $this->render("Contact/index.html.twig", ["breadcrumb" => "Kontakt", "content" => $content]);
    }
}