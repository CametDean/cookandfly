<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\IngredientCleRepository;

class IngredientCleController extends AbstractController
{
    /**
     * @Route("/ingredient/cle/{nom}", name="ingredient_cle")
     */
    public function affichageIngredientCle(IngredientCleRepository $ecr, $nom)
    { 
        $ingredientCle = $ecr->findOneBy(["nom" => $nom]);
        return $this->render('ingredient_cle/index.html.twig', compact("ingredientCle"));
    }
}
