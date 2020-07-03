<?php

namespace App\Controller;

use App\Entity\Aircraft;
use App\Entity\Airport;
use App\Entity\Flight;
use App\Repository\AircraftRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/** @Route("/aircraft") */
class AircraftController extends AbstractController
{
    private $_repository;

    public function __construct(AircraftRepository $repository)
    {
        $this->_repository = $repository;
    }

    /**
     * @Route("/", name="aircraft_index")
     */
    public function indexAction()
    {
        $aircraft = $this->_repository->findAll();

        return $this->render('aircraft/index.html.twig', array(
            "aircrafts" => $aircraft
        ));
    }

    /**
     * @Route("/add", name="aircraft_add")
     */
    public function addAction()
    {
        $em = $this->getDoctrine()->getManager();

        $aircraft = new Aircraft();
        $aircraft->setManufacturer('Boeing');
        $aircraft->setBasicType('AR-330-XX');

        $aircraft2 = new Aircraft();
        $aircraft2->setManufacturer('Boeing');
        $aircraft2->setBasicType('AR-320-YY');

        $em->persist($aircraft);
        $em->persist($aircraft2);
        $em->flush();

        return $this->redirectToRoute('aircraft_index');
    }
}
