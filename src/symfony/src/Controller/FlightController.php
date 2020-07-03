<?php

namespace App\Controller;

use App\Entity\Flight;
use App\Form\FlightType;
use App\Repository\FlightRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/flight")
 */
class FlightController extends AbstractController
{
    private $_repository;

    public function __construct(FlightRepository $repository)
    {
        $this->_repository = $repository;
    }

    /**
     * @Route("/", name="flight_index")
     */
    public function indexAction()
    {
        $flights = $this->_repository->findAll();

        return $this->render('flight/index.html.twig', array(
            'flights' => $flights
        ));
    }

    /**
     * @Route("/view/{id}", name="flight_view")
     */
    public function viewAction($id)
    {
        $flight = $this->_repository->find($id);

        if (is_null($flight)) {
            throw $this->createNotFoundException('Page introuvable.');
        }

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

    /**
     * @Route("/{id}/edit", name="flight_edit", methods={"GET","POST"})
     */
    public function editAction(Request $request, Flight $flight)
    {
        $form = $this->createForm(FlightType::class, $flight);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('airport_index');
        }

        return $this->render('flight/edit.html.twig', [
            'flight' => $flight,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="flight_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Flight $flight): Response
    {
        if ($this->isCsrfTokenValid('delete'.$flight->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($flight);
            $entityManager->flush();
        }

        return $this->redirectToRoute('flight_index');
    }
}