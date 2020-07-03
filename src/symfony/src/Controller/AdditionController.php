<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class AdditionController extends AbstractController
{
    /**
     * @Route("/addition", name="addition")
     */
    public function index(SessionInterface $session)
    {

        $xmin = $session->get('xmin', 1); 
        $xmax = $session->get('xmax' , 5); 
        $ymin = $session->get('ymin', 1); 
        $ymax = $session->get('ymax', 5);
        
        $session->set('xmin', $xmin);
        $session->set('xmax', $xmax);
        $session->set('ymin', $ymin);
        $session->set('ymax', $ymax);


        return $this->render('addition/index.html.twig', [
            'controller_name' => 'IndexController',
            'xmin' => $xmin,
            'xmax' => $xmax,
            'ymin' => $ymin,
            'ymax' => $ymax,
        ]);
    }

     /**
     * @Route("/addition/{xmin}/{xmax}/{ymin}/{ymax}", name="addition_action", requirements = {"xmin"="^[1-9]\d*$","xmax"="^[1-9]\d*$","ymin"="^[1-9]\d*$","ymax"="^[1-9]\d*$", })
     */
    public function additionAction($xmin, $xmax, $ymin, $ymax, SessionInterface $session)
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


        return $this->render('addition/addition.html.twig', [
            'controller_name' => 'AdditionController',
            'xmin' => $xmin,
            'xmax' => $xmax,
            'ymin' => $ymin,
            'ymax' => $ymax,
        ]);
    }

}
