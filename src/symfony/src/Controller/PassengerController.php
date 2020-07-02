<?php

namespace App\Controller;

use App\Entity\Passenger;
use App\Repository\PassengerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/passenger")
 */
class PassengerController extends AbstractController
{
    private $_repository;

    public function __construct(PassengerRepository $repository)
    {
        $this->_repository = $repository;
    }

    /**
     * @Route("/", name="passenger_index")
     */
    public function indexAction()
    {
        $passengers = $this->_repository->findAll();

        return $this->render('passenger/index.html.twig', array(
            'passengers' => $passengers
        ));
    }

    /**
     * @Route("/add", name="passenger_add")
     */
    public function addAction(Request $request)
    {
        $passenger = new Passenger();

        $formulaire = $this->createFormBuilder($passenger)
            ->add('firstName', TextType::class, ['label' => 'Prénom : '])
            ->add('lastName', TextType::class, ['label' => 'Nom : '])
            ->add('passportNumber', TextType::class, ['label' => 'Passeport : '])
            ->add('enregistrer', SubmitType::class, ['label' => 'Enregistrer'])
            ->getForm();

        if ($request->isMethod('POST')) {
            $formulaire->handleRequest($request);

            if ($formulaire->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($passenger);
                $em->flush();
                return $this->redirectToRoute('passenger_index');
            }
        }

        return $this->render('passenger/add.html.twig', array(
            'formulaire' => $formulaire->createView()
        ));
    }
}
