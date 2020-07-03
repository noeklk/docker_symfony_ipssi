<?php

namespace App\Controller;

use App\Entity\Airport;
use App\Entity\Flight;
use App\Form\AirportType;
use App\Repository\AirportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/** @Route("/airport") */
class AirportController extends AbstractController
{
    private $_repository;

    public function __construct(AirportRepository $repository)
    {
        $this->_repository = $repository;
    }

    /**
     * @Route("/{page}/{col}/{sens}", name="airport_index", requirements={"page"="\d+", "sens"="asc|desc"}, defaults={"col":"id", "sens":"ASC", "page": 1})
     */
    public function indexAction($page, $col, $sens)
    {
        $airports = $this->_repository->findAllWithPaginationAndOrder($page, $col, $sens);
        $airportsNumber = $this->_repository->getAllCount();

        return $this->render('airport/index.html.twig', array(
            "airports" => $airports,
            "airportsNumber" => $airportsNumber,
            "page" => $page,
            "col" => $col,
            "sens" => $sens
        ));
    }

    /**
     * @Route("/index/{letter}", name="airport_list_alpha", requirements={"letter": "[A-Z]{1}"})
     */
    public function indexLetterAction($letter)
    {
        $airports = $this->_repository->findAllByFirstLetter($letter);

        return $this->render('airport/index-letter.html.twig', array(
            "airports" => $airports,
            "letterChosen" => $letter
        ));
    }


    /**
     * @Route("/view/{id}", name="airport_view")
     */
    public function viewAction($id)
    {
        $airport = $this->_repository->find($id);

        if (is_null($airport))
            throw $this->createNotFoundException('Page introuvable.');

        return $this->render('airport/view.html.twig', array(
            "airport" => $airport
        ));
    }

    /**
     * @Route("/{id}", name="airport_delete", methods={"DELETE"})
     */
    public function deleteAction(Request $request, Airport $airport)
    {
        if ($this->isCsrfTokenValid('delete' . $airport->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($airport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('airport_index');
    }

    /**
     * @Route("/edit/{id}", name="airport_edit", methods={"GET","POST"})
     */
    public function editAction(Request $request, Airport $airport)
    {
        $form = $this->createForm(AirportType::class, $airport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('airport_index');
        }

        return $this->render('airport/edit.html.twig', [
            'airport' => $airport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/add", name="airport_add")
     */
    public function addAction(Request $request)
    {
        $airport = new Airport();
        $form = $this->createForm(AirportType::class, $airport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($airport);
            $entityManager->flush();

            return $this->redirectToRoute('airport_index');
        }

        return $this->render('airport/add.html.twig', [
            'airport' => $airport,
            'form' => $form->createView(),
        ]);
    }
}
