<?php

namespace App\Controller;

use App\Entity\Airport;
use App\Entity\Flight;
use App\Repository\AirportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        return $this->render('Airport/index-letter.html.twig', array(
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
     * @Route("/delete/{id}", name="airport_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $airport = $this->_repository->find($id);

        if (is_null($airport))
            throw $this->createNotFoundException('Page introuvable.');

        $em->remove($airport);
        $em->flush();

        return $this->redirectToRoute('airport_index');
    }

    /**
     * @Route("/edit/{id}", name="airport_edit")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $airport = $this->_repository->find($id);

        if (is_null($airport))
            throw $this->createNotFoundException('Page introuvable.');

        $airport->setName($airport->getName() . 'Z');
        $em->flush();

        return $this->redirectToRoute('airport_index');
    }

    /**
     * @Route("/add", name="airport_add")
     */
    public function addAction()
    {
        $em = $this->getDoctrine()->getManager();

        $airport = new Airport();
        $airport->setIdent('XXXX');
        $airport->setName('Test ajout aeroport 3');

        $em->persist($airport);
        $em->flush();

        return $this->redirectToRoute('airport_index');
    }
}
