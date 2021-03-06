<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface as EMI;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;
use App\Form\RecetteType;
use App\Entity\Recette;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\RecetteRepository;


class UserController extends AbstractController
{
    /**
     * @Route("/profile/user", name="user")
     */
    public function index(UserRepository $ur, Request $rq, RecetteRepository $rr)
    {
        if($rq->isMethod("POST")){
            $nomRecette = $rq->request->get("search");
            $recettes = $rr->findByName($nomRecette);
            return $this->render('continent/index.html.twig', compact("recettes"));
        } else{
            $user = $this->getUser();
        }
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/profile/user/update", name="user_update")
     */
    public function update(Request $request, EMI $em)
    {
        $bouton = "update";
        $userAmodifier = $this->getUser();

        $formUser = $this->createForm(UserType::class, $userAmodifier);
        $formUser->handleRequest($request);

        if($formUser->isSubmitted()){
            if($formUser->isValid()){
                $em->persist($userAmodifier);
                $em->flush();
                $this->addFlash("success", "Vous avez bien modifié vos informations personnelles");
                return $this->redirectToRoute("user");
            }else{
                $this->addFlash("danger", "Le formulaire n'est pas valide");
            }
        }

        $formUser = $formUser->createView();
        return $this->render('user/formulaire.html.twig', compact("formUser", "bouton"));
    }

    /**
     * @Route("/profile/user/recette/ajouter", name="user_recette_add")
     */
    public function add(Request $rq, EMI $em)
    {
        $bouton = "add";
        $formRecette = $this->createForm(RecetteType::class);
        $formRecette->handleRequest($rq);

        if($formRecette->isSubmitted()){
            if($formRecette->isValid()){

                $nouvelleRecette = $formRecette->getData(); 

                $destination = $this->getParameter("dossier_images");

                if($photoTelechargee = $formRecette["photo"]->getData()){
                    $nomPhoto = pathinfo($photoTelechargee->getClientOriginalName(), PATHINFO_FILENAME);
                    $newName = trim($nomPhoto);
                    $newName = str_replace(" ", "_", $newName);
                    $newName .= "-" . uniqid() . "." . $photoTelechargee->getExtension();
                    $photoTelechargee->move($destination, $newName);
                    //dd($nomPhoto, $newName);
                    $nouvelleRecette->setPhoto($newName);
                    $em->persist($nouvelleRecette);
                    $em->flush();
                    $this->addFlash("success", "La recette a bien été ajoutée");
                    return $this->redirectToRoute("user");
                } 
            }else{
                $this->addFlash("danger", "Le formulaire n'est pas valide");
            }
        }

        $formRecette = $formRecette->createView();
        
        return $this->render('recette/formulaire.html.twig', compact("formRecette", "bouton"));
    }

    //------- GESTION USERS ------

    /**
     * @Route("/admin/user/liste", name="user_list")
     */
    public function listeUser(UserRepository $ur)
    {
        $users = $ur->findAll();
        return $this->render('user/liste.html.twig', compact("users"));
    }

    /**
     * @Route("/admin/user/supprimer/{id}", name="user_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(UserRepository $ar, Request $request,EMI $em, int $id)
    {
        $bouton = "delete";
        $userAsupprimer = $ar->find($id);

        $formUser = $this->createForm(UserType::class, $userAsupprimer);

        if ($request->isMethod("POST")){
            $em->remove($userAsupprimer);
            $em->flush();
            return $this->redirectToRoute("user_list");
        }
        $formUser = $formUser->createView();
        return $this->render('user/formulaire.html.twig', compact("formUser", "bouton"));

    }
}
