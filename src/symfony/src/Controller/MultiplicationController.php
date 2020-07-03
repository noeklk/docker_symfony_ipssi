<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MultiplicationController extends AbstractController
{
    /**
     * @Route("/multiplication/{xmin}/{xmax}/{ymin}/{ymax}", name="multiplication", requirements={"xmin"="^[0-9]+", "xmax"="^[0-9]+", "x=ymin"="^[0-9]+", "ymax"="^[0-9]+"})
     */
    public function multiplicationAction($xmin,$xmax,$ymin,$ymax, SessionInterface $session)
    {
        //verif si xmin et ymin > ymin et ymax
        if($xmin > $xmax) {
            $tmp = $xmin;
            $xmin = $xmax;
            $xmax = $tmp;
        }
        if($ymin > $ymax) {
            $tmp = $ymin;
            $ymin = $ymax;
            $ymax = $tmp;
        }

        $ligne = range($ymin, $ymax);
        $colonne = range($xmin, $xmax);

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

        $ligne = range($ymin, $ymax);
        $colonne = range($xmin, $xmax);

        return $this->render('multiplication/index.html.twig', [
            'ligne' => $ligne,
            'colonne' => $colonne,
        ]);
    }
}
