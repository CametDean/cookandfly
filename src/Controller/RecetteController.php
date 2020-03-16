<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface as EMI;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\RecetteType;

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
    
    /**
     * @Route("/admin/recette/liste", name="recipe_show")
     * @IsGranted("ROLE_ADMIN")
     */
    public function affichageRecettesAll(RecetteRepository $rr)
    {  
        $recettes = $rr->findAll();   
        return $this->render('recette/listeRecettes.html.twig', compact("recettes"));
    }

    /**
     * @Route("/admin/recette/modifier/{id}", name="recipe_update", requirements={"id"="\d+"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function update(RecetteRepository $ar, Request $request, EMI $em, int $id)
    {
        $bouton = "update";
        $recetteAmodifier = $ar->find($id);

        $formRecette = $this->createForm(RecetteType::class, $recetteAmodifier);
        $formRecette->handleRequest($request);
        if($formRecette->isSubmitted()){
            if($formRecette->isValid()){
                $em->persist($recetteAmodifier);
                $em->flush();
                $this->addFlash("success", "Vous avez bien modifié la recette");
                return $this->redirectToRoute("recipe_show");
            }else{
                $this->addFlash("danger", "Le formulaire n'est pas valide");
            }
        }

        $formRecette = $formRecette->createView();
        
        return $this->render('recette/formulaire.html.twig', compact("formRecette", "bouton")); 
    }

    /**
     * @Route("/adimn/recette/supprimer/{id}", name="recipe_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(RecetteRepository $ar, Request $request,EMI $em, int $id)
    {
        $bouton = "delete";
        $recetteAsupprimer = $ar->find($id);

        $formRecette = $this->createForm(RecetteType::class, $recetteAsupprimer);
        //$formRecette->handleRequest($request);
        
        if($request->isMethod("POST")){
            
            $em->remove($recetteAsupprimer);
            $em->flush();
            $this->addFlash("success", "Vous avez bien suprimé la recette");
            return $this->redirectToRoute("recipe_show");
        
        }

        $formRecette = $formRecette->createView();
        return $this->render('recette/formulaire.html.twig', compact("formRecette", "bouton"));

    }
}
