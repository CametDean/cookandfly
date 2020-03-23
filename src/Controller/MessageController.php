<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface as EMI;
use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use App\Repository\CommentaireRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class MessageController extends AbstractController
{
    /**
     * @Route("/message", name="message")
     *
     */
    public function index(Request $request)
    {
        $em          = $this->getDoctrine()->getManager();
        $message     = new Message();
        $form        = $this->createForm(MessageType::class, $message);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->persist($message);
            $em->flush();
            $this->addFlash("success", "Votre message a bien été envoyé");
            return $this->redirectToRoute("user");
        }
        
        return $this->render('message/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    //Gestion Messages


    /**
     * @Route("/admin/message/list", name="message_list")
     * * @IsGranted("ROLE_ADMIN")
     */
    public function affichageMessages(MessageRepository $mr, CommentaireRepository $cr)
    {      
        $messages = $mr->findAll();
        $commentaires = $cr->findAll();

        return $this->render('user/admin.html.twig', compact("messages", "commentaires"));
       
    }


    /**
     * @Route("/admin/message/supprimer/{id}", name="message_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(MessageRepository $mr, Request $request,EMI $em, int $id)
    {
        $bouton = "delete";
        $messageAsupprimer = $mr->find($id);

        $formMessage = $this->createForm(MessageType::class, $messageAsupprimer);

        if ($request->isMethod("POST")){
            $em->remove($messageAsupprimer);
            $em->flush();
            return $this->redirectToRoute("message_list");
        }
        $formMessage = $formMessage->createView();
        return $this->render('message/formulaire.html.twig', compact("formMessage", "bouton"));

    }

    /**
     * @Route("/admin/commentaire/supprimer/{id}", name="comment_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteCom(CommentaireRepository $cr, Request $request,EMI $em, int $id)
    {
        $messageAsupprimer = $cr->find($id);
        $em->remove($messageAsupprimer);
        $em->flush();
        return $this->redirectToRoute("message_list"); 
    }
}
