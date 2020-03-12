<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContinentRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ContinentRepository $cr)
    { 
        $continents = $cr->findAll();
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
