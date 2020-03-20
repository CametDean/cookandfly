<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface as EMI;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\RecetteType;
use App\Repository\CommentaireRepository;
use App\Form\CommentaireType;
use App\Entity\Commentaire;

class RecetteController extends AbstractController
{
    /**
     * @Route("/recette/{id}", name="affichage_recette", requirements={"id"="\d+"})
     */
    public function affichageRecettes(RecetteRepository $rr, CommentaireRepository $cr, Request $rq, EMI $em, $id)
    {  
        $recette = $rr->findOneBy(["id" => $id]);
        $user = $this->getUser();
        $commentaires = $recette->getCommentaire();  

        if($rq->isMethod("POST")){
            $comment = $rq->request->get('description'); 
            $date = new \DateTime;
            $newComment = (new Commentaire)->setAbonne($user)->setDate($date)->setDescription($comment)->setRecette($recette);
            $em->persist($newComment);
            $em->flush(); 
        }

        return $this->render('recette/index.html.twig', compact("recette", "commentaires"));
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
