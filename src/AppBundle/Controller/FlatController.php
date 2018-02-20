<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 2018-02-19
 * Time: 20:05
 */

namespace AppBundle\Controller;

use AppBundle\EventDispatcher\FlatEvent;
use AppBundle\EventDispatcher\Events;
use AppBundle\Entity\Flat;
use AppBundle\Form\FlatType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class FlatController extends Controller {
    /**
     * @Route("/mieszkania", name="flat_index")
     * @return Response
     */
    public function indexAction(){
        $entityManager = $this->getDoctrine()->getManager();
        $flats = $entityManager->getRepository(Flat::class)->findActiveOrdered();

        $logger = $this->get('logger');
        $logger->info("Ktoś odwiedza listę mieszkań");

        $content = [
            "title" => "Domyślny tytuł dla tekstu Mieszkania",
            "body" => "Chociaż od nikogo jako czasu panowania Fryderyka Wielkiego, Króla Pruskiego."
        ];
        return $this->render("Flat/index.html.twig", ["flats" => $flats, "breadcrumb" => "Mieszkania", "content" => $content]);
    }

    /**
     * @Route("/mieszkanie/dodaj", name="flat_add")
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function addFlat(Request $request){
        $this->denyAccessUnlessGranted("ROLE_USER");

        $flat = new Flat();

        $form = $this->createForm(FlatType::class, $flat);

        if ($request->isMethod("post")) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $flat
                    ->setOwner($this->getUser());

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($flat);
                $entityManager->flush();//to zapisuje do bazy

                //rzucanie eventem
                $this->get("event_dispatcher")->dispatch(Events::FLAT_ADD, new FlatEvent($flat));

                $this->addFlash("success", "Mieszkanie {$flat->getTitle()} zostało dodane.");

                return $this->redirectToRoute("flat_index");
            }

            $this->addFlash("error", "Błąd! Nie udało się dodać mieszkania");

        }

        return $this->render("UserFlat/add.html.twig", ["form" => $form->createView(), "breadcrumb" => "Dodaj mieszkanie", "content" => ""]);
    }
}