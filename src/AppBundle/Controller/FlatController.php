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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class FlatController extends Controller {
    /**
     * Metoda domyślnej listy mieszkań.
     *
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
     * Metoda dodawania mieszkania.
     *
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
                $entityManager->flush();

                //rzucanie eventem
                $this->get("event_dispatcher")->dispatch(Events::FLAT_ADD, new FlatEvent($flat));

                $this->addFlash("success", "Mieszkanie {$flat->getTitle()} zostało dodane.");

                return $this->redirectToRoute("flat_index");
            }

            $this->addFlash("error", "Błąd! Nie udało się dodać mieszkania");

        }

        return $this->render("UserFlat/add.html.twig", ["form" => $form->createView(), "breadcrumb" => "Dodaj mieszkanie", "content" => ""]);
    }

    /**
     * Metoda dla widoku szczegółów mieszkań (tworzone formularze usuwania i kończenia).
     *
     * @Route("/mieszkanie/szczegoly/{id}", name="flat_details")
     *
     * @param Flat $flat
     * @return Response
     */
    public function detailsAction(Flat $flat){
        $this->denyAccessUnlessGranted("ROLE_USER");

        $deleteForm = $this->createFormBuilder()
            ->setAction($this->generateUrl("flat_delete", ["id" => $flat->getId()]))
            ->setMethod(Request::METHOD_DELETE)
            ->add("submit", SubmitType::class, ["label" => "Usuń"])
            ->getForm();

        $finishForm = $this->createFormBuilder()
            ->setAction($this->generateUrl("flat_finish", ["id" => $flat->getId()]))
            ->setMethod(Request::METHOD_POST)
            ->add("submit", SubmitType::class, ["label" => "Zakończ"])
            ->getForm();

        return $this->render("Flat/details.html.twig",
            [
                "flat" => $flat,
                "deleteForm" => $deleteForm->createView(),
                "finishForm" => $finishForm->createView(),
                "breadcrumb" => "Szczegóły mieszkania",
                "content" => ""
            ]
        );
    }

    /**
     * @Route("/mieszkanie/usun/{id}", name="flat_delete", methods={"DELETE"})
     *
     * @param Flat $flat
     * @throws AccessDeniedException
     * @return RedirectResponse
     */
    public function deleteAction(Flat $flat){
        $this->denyAccessUnlessGranted("ROLE_USER");

        if ($this->getUser() !== $flat->getOwner()) {
            throw new AccessDeniedException();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($flat);
        $entityManager->flush();

        $this->get("event_dispatcher")->dispatch(Events::FLAT_DELETE, new FlatEvent($flat));

        $this->addFlash("success", "Mieszkanie {$flat->getTitle()} zostało usunięte.");

        return $this->redirectToRoute("flat_index");
    }

    /**
     * @Route("/mieszkanie/zakoncz/{id}", name="flat_finish", methods={"POST"})
     *
     * @param Flat $flat
     * @throws AccessDeniedException
     * @return RedirectResponse
     */
    public function finishAction(Flat $flat){
        $this->denyAccessUnlessGranted("ROLE_USER");

        if ($this->getUser() !== $flat->getOwner()) {
            throw new AccessDeniedException();
        }

        $flat
            ->setExpiresAt(new \DateTime());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($flat);
        $entityManager->flush();

        $this->get("event_dispatcher")->dispatch(Events::FLAT_FINISH, new FlatEvent($flat));

        $this->addFlash("success", "Oferta na mieszkanie {$flat->getTitle()} została zakończona.");

        return $this->redirectToRoute("flat_details", ["id" => $flat->getId()]);
    }
}