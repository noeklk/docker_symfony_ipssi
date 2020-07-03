<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class MultiplicationController extends AbstractController
{
    /**
     * @Route("/multiplication", name="multiplication")
     */
    public function index(SessionInterface $session)
    {
        $xmin = $session->get('xmin', 1); 
        $xmax = $session->get('xmax' , 10); 
        $ymin = $session->get('ymin', 1); 
        $ymax = $session->get('ymax', 10); 
        
        $session->set('xmin', $xmin);
        $session->set('xmax', $xmax);
        $session->set('ymin', $ymin);
        $session->set('ymax', $ymax);


        return $this->render('multiplication/index.html.twig', [
            'controller_name' => 'Index Multiplication Controller',
            'xmin' => $xmin,
            'xmax' => $xmax,
            'ymin' => $ymin,
            'ymax' => $ymax,
        ]);
    }
     /**
     * @Route("/multiplication/{xmin}/{xmax}/{ymin}/{ymax}", name="multiplication_action", requirements = {"xmin"="^[1-9]\d*$","xmax"="^[1-9]\d*$","ymin"="^[1-9]\d*$","ymax"="^[1-9]\d*$", })
     */
    public function multiplicationAction($xmin, $xmax, $ymin, $ymax, SessionInterface $session)
    {
        
        if($xmin> $xmax) {
            $tmp = $xmin;
            $xmin = $xmax;
            $xmax = $tmp; 
        }

        if($ymin> $ymax) {
            $tmp = $ymin;
            $ymin = $ymax;
            $ymax = $tmp; 
        }
        
        $session->set('xmin', $xmin);        
        $session->set('xmax', $xmax);
        $session->set('ymin', $ymin);
        $session->set('ymax', $ymax);


        return $this->render('multiplication/multiplication.html.twig', [
            'controller_name' => 'Multiplication Controller',
            'xmin' => $xmin,
            'xmax' => $xmax,
            'ymin' => $ymin,
            'ymax' => $ymax,
        ]);
    }
}
