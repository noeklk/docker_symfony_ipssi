<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PassengerController extends AbstractController
{
    /**
     * @Route("/passenger", name="passenger")
     */
    public function index()
    {
        return $this->render('passenger/index.html.twig', [
            'controller_name' => 'PassengerController',
        ]);
    }
}
