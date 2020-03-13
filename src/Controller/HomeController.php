<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContinentRepository;
use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ContinentRepository $cr, RecetteRepository $rr, Request $rq)
    { 
        if($rq->isMethod("POST")){
            $nomRecette = $rq->request->get("search");
            $recettes = $rr->findByName($nomRecette);
            return $this->render('continent/index.html.twig', compact("recettes"));
        } else{
          $continents = $cr->findAll();
        }
        return $this->render('home/index.html.twig', compact("continents"));
    }

    /**
     * @Route("/communaute", name="communaute")
     */
    public function communaute()
    { 
        return $this->render('home/communaute.html.twig');
    }
    
}
