<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecetteRepository;

class RecetteController extends AbstractController
{
    /**
     * @Route("/recette/{nom}", name="affichage_recette")
     */
    public function affichageRecettes(RecetteRepository $rr, $nom)
    { 
        $recette = $rr->findOneBy(["nom" => $nom]);
        return $this->render('recette/index.html.twig', compact("recette"));
    }
}
