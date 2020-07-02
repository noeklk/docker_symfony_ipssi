<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FlightController extends AbstractController
{
    /**
     * @Route("/flight", name="flight")
     */
    public function index()
    {
        return $this->render('flight/index.html.twig', [
            'controller_name' => 'FlightController',
        ]);
    }
}
