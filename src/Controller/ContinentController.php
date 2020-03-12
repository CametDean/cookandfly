<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContinentRepository;

class ContinentController extends AbstractController
{
    /**
     * @Route("/{id}", name="affichage_continent")
     */
    public function affichageRecettesAsie(ContinentRepository $cr, $id)
    { 
        $continent = $cr->find($id);
        return $this->render('continent/index.html.twig', compact("continent"));
    }
}
