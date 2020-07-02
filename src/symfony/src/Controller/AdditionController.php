<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdditionController extends AbstractController
{
    /**
     * @Route("/addition", name="addition")
     */
    public function index()
    {
        return $this->render('addition/index.html.twig', [
            'controller_name' => 'AdditionController',
        ]);
    }

     /**
     * @Route("/addition/{xmin}/{xmax}/{ymin}/{ymax}", name="addition_action", requirements = {"xmin"="^[1-9]\d*$","xmax"="^[1-9]\d*$","ymin"="^[1-9]\d*$","ymax"="^[1-9]\d*$", })
     */
    public function additionAction($xmin, $xmax, $ymin, $ymax)
    {
        
        return $this->render('addition/addition.html.twig', [
            'controller_name' => 'AdditionController',
            'xmin' => $xmin,
            'xmax' => $xmax,
            'ymin' => $ymin,
            'ymax' => $ymax,
        ]);
    }

}
