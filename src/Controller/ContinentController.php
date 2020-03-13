<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContinentRepository;
use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Request;

class ContinentController extends AbstractController
{
    /**
     * @Route("/continent/{nom}", name="affichage_continent")
     */
    public function affichageRecettesAsie(ContinentRepository $cr, $nom, Request $rq, RecetteRepository $rr)
    { 
        
        if($rq->isMethod("POST")){
            $nomRecette = $rq->request->get("search");
            $recettes = $rr->findByName($nomRecette);
            return $this->render('continent/index.html.twig', compact("recettes"));
        } else{
          $continent = $cr->findOneBy(["nom" => $nom]); 
        }
        return $this->render('continent/index.html.twig', compact("continent"));
    }
}
