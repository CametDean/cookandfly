<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\IngredientCleRepository;
use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Request;

class IngredientCleController extends AbstractController
{
    /**
     * @Route("/ingredient/cle/{nom}", name="ingredient_cle")
     */
    public function affichageIngredientCle(IngredientCleRepository $ecr, $nom, Request $rq, RecetteRepository $rr)
    { 
        if($rq->isMethod("POST")){
            $nomRecette = $rq->request->get("search");
            $recettes = $rr->findByName($nomRecette);
            return $this->render('continent/index.html.twig', compact("recettes"));
        } else{
            $ingredientCle = $ecr->findOneBy(["nom" => $nom]);
        }
        return $this->render('ingredient_cle/index.html.twig', compact("ingredientCle"));
    }
}
