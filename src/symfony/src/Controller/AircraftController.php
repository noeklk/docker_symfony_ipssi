<?php

namespace App\Controller;

use App\Entity\Aircraft;
use App\Form\AircraftType;
use App\Repository\AircraftRepository;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    public function addAction(Request $request)
    {
        $aircraft = new Aircraft();
        $formulaire = $this->get('form.factory')->create(AircraftType::class, $aircraft);

        if ($request->isMethod('POST')) {
            $formulaire->handleRequest($request);

            if ($formulaire->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($aircraft);
                $em->flush();
                return $this->redirectToRoute('aircraft_index');
            }
        }

        return $this->render('aircraft/add.html.twig', array(
            'formulaire' => $formulaire->createView()
        ));
    }

    /**
     * @Route("/edit/{id}", name="aircraft_edit")
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $aircraft = $this->_repository->find($id);
        $formulaire = $this->get('form.factory')->create(AircraftType::class, $aircraft);

        if ($request->isMethod('POST')) {
            $formulaire->handleRequest($request);

            if ($formulaire->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($aircraft);
                $em->flush();
                return $this->redirectToRoute('aircraft_index');
            }
        }

        return $this->render('aircraft/edit.html.twig', array(
            'formulaire' => $formulaire->createView()
        ));
    }

    /**
     * @Route("/delete/{id}", name="aircraft_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $aircraft = $this->_repository->find($id);

        $em->remove($aircraft);

        try {
            $em->flush();
        } catch (\Throwable $th) {
            return $this->render('aircraft/delete.html.twig', array(
                'deleteMessage' => "L'avion portant l'id: $id n'a pas été supprimé car il est dépendant d'un vol"
            ));
        }

        return $this->render('aircraft/delete.html.twig', array(
            'deleteMessage' => "L'avion portant l'id: $id a été supprimé"
        ));
    }
}
