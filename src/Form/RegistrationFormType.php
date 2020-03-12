<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', Type\TextType::class, [
                "constraints" => [
                    new Length([
                        "min" => 2,
                        "max" => 10, 
                        "minMessage" => "Le pseudo doit comporter au minimum 2 caractères",
                        "maxMessage" => "Le pseudo ne doit pas dépasser les 10 caractères"
                    ])
                ]
            ])
            ->add('roles')
            ->add('password', Type\PasswordType::class, [
                "constraints" => [
                    new Length([
                        "min" => 6, 
                        "minMessage" => "Le mot de passe doit comporter au minimum 6 caractères"
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
