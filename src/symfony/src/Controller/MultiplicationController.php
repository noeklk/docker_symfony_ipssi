<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MultiplicationController extends AbstractController
{
    /**
     * @Route("/multiplication/{xmin}/{xmax}/{ymin}/{ymax}", name="multiplication")
     */
    public function multiplicationAction($xmin,$xmax,$ymin,$ymax, SessionInterface $session)
    {
        $ligne = [];
        $colonne = [];

        for ($i=$xmin; $i <= $xmax; $i++) { 
            array_push($colonne, $i);
        }

        for ($i=$ymin; $i <= $ymax; $i++) { 
            array_push($ligne, $i);
        }

        //Save in session
        $session->set('xmin', $xmin);
        $session->set('xmax', $xmax);
        $session->set('ymin', $ymin);
        $session->set('ymax', $ymax);


        return $this->render('multiplication/index.html.twig', [
            'ligne' => $ligne,
            'colonne' => $colonne,
        ]);
    }

    /**
     * @Route("/multiplication", name="multiplication_index")
     */
    public function addition(SessionInterface $session)
    {

        //Get from session
        $xmin = $session->get('xmin', 1);
        $xmax = $session->get('xmax', 10);
        $ymin = $session->get('ymin', 1);
        $ymax = $session->get('ymax', 10);

        //Save in session
        $session->set('xmin', $xmin);
        $session->set('xmax', $xmax);
        $session->set('ymin', $ymin);
        $session->set('ymax', $ymax);

        $ligne = [];
        $colonne = [];

        //tableau de colonne de $xmin à $xmax
        for ($i=$xmin; $i <= $xmax; $i++) { 
            array_push($colonne, $i);
        }

        //tableau de ligne de $ymin à $ymax
        for ($i=$ymin; $i <= $ymax; $i++) { 
            array_push($ligne, $i);
        }


        return $this->render('multiplication/index.html.twig', [
            'ligne' => $ligne,
            'colonne' => $colonne,
        ]);
    }
}