<?php

namespace App\Controller;

use App\Entity\Flight;
use App\Repository\FlightRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/flight")
 */
class FlightController extends AbstractController
{
    /**
     * @Route("/", name="flight_index")
     */
    public function indexAction(FlightRepository $repository)
    {
        $flights = $repository->findAll();

        return $this->render('flight/index.html.twig', array(
            'flights' => $flights
        ));
    }

    /**
     * @Route("/view/{id}", name="flight_view")
     */
    public function viewAction($id, FlightRepository $repository)
    {
        $flight = $repository->find($id);

        if (is_null($flight))
            throw $this->createNotFoundException('Page introuvable.');

        return $this->render('flight/view.html.twig', array(
            "flight" => $flight
        ));
    }

    /**
     * @Route("/add", name="flight_add")
     */
    public function addAction(Request $request)
    {
        $flight = new Flight();

        $formulaire = $this->get('form.factory')
            ->create(FlightType::class, $flight);

        if ($request->isMethod('POST')) {
            $formulaire->handleRequest($request);

            if ($formulaire->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($flight);
                $em->flush();
                return $this->redirectToRoute('flight_index');
            }
        }

        return $this->render('flight/add.html.twig', array(
            'formulaire' => $formulaire->createView()
        ));
    }
}
