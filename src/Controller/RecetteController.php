<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecetteRepository;


class RecetteController extends AbstractController
{
    /**
     * @Route("/recette/{id}", name="affichage_recette", requirements={"id"="\d+"})
     */
    public function affichageRecettes(RecetteRepository $rr, $id)
    {  
        $recette = $rr->findOneBy(["id" => $id]);   
        return $this->render('recette/index.html.twig', compact("recette"));
    }
    
}
