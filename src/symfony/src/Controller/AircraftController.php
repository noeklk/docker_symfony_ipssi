<?php

namespace App\Controller;

use App\Entity\Aircraft;
use App\Form\AircraftType;
use App\Repository\AircraftRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/aircraft")
 */
class AircraftController extends AbstractController
{
    /**
     * @Route("/", name="aircraft_index", methods={"GET"})
     */
    public function index(AircraftRepository $aircraftRepository): Response
    {
        return $this->render('aircraft/index.html.twig', [
            'aircraft' => $aircraftRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="aircraft_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $aircraft = new Aircraft();
        $form = $this->createForm(AircraftType::class, $aircraft);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aircraft);
            $entityManager->flush();

            return $this->redirectToRoute('aircraft_index');
        }

        return $this->render('aircraft/new.html.twig', [
            'aircraft' => $aircraft,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="aircraft_show", methods={"GET"})
     */
    public function show(Aircraft $aircraft): Response
    {
        return $this->render('aircraft/show.html.twig', [
            'aircraft' => $aircraft,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="aircraft_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Aircraft $aircraft): Response
    {
        $form = $this->createForm(AircraftType::class, $aircraft);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('aircraft_index');
        }

        return $this->render('aircraft/edit.html.twig', [
            'aircraft' => $aircraft,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="aircraft_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Aircraft $aircraft): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aircraft->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($aircraft);
            $entityManager->flush();
        }

        return $this->redirectToRoute('aircraft_index');
    }
}
