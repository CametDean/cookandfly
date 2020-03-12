<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContinentRepository;

class ContinentController extends AbstractController
{
    /**
     * @Route("/{nom}", name="affichage_continent")
     */
    public function affichageRecettesAsie(ContinentRepository $cr, $nom)
    { 
        $continent = $cr->findOneBy(["nom" => $nom]);
        return $this->render('continent/index.html.twig', compact("continent"));
    }
}
