<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom' ,Type\TextType::class, [
                "constraints" => [ 
                    new Constraints\NotBlank([ "message" => "Ce champ ne peut être vide"]),
                    new Constraints\Length([ "min" => 2, "max" => 50, 
                                             "minMessage" => "Le nom de l'abonne doit comporter au moins 2 caractères",
                                             "maxMessage" => "Le nom de l'abonne ne peut pas dépasser 50 caractères"
                                           ])
                 ] 
            ])
            ->add('Prenom' , Type\TextType::class, [
                "constraints" => [ 
                    new Constraints\NotBlank([ "message" => "Ce champ ne peut être vide"]),
                    new Constraints\Length([ "min" => 2, "max" => 50, 
                                             "minMessage" => "Le Prenom de l'abonné doit comporter au moins 2 caractères",
                                             "maxMessage" => "Le Prenom de l'abonné ne peut pas dépasser 50 caractères"
                                           ])
                 ] 
            ])
            ->add('Email')
            ->add('Objet' , Type\TextType::class, [ "attr" => [ "placeholder" => "Objet du Message"] ])
            ->add('message' , Type\TextareaType::class, [ "required" => false, "label" => "message" ])
            // ->add('send', Type\SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
