<?php

namespace App\Form;

use App\Entity\Recette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Continent;
use App\Entity\IngredientCle;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('ingredients')
            ->add('ingredientCle', EntityType::class, [
                'placeholder' => "Choisissez un ingrédient clé",
                'required' => false,
                'class' => IngredientCle::class,
                "choice_label" => function(IngredientCle $ingredientCle){
                    return $ingredientCle->getNom();
                }
            ])
            ->add('description')
            ->add('photo', FileType::class, ['mapped' => false])
            ->add('pays')
            ->add('continent', EntityType::class, [
                'class' => Continent::class,
                "choice_label" => function(Continent $continent){
                    return $continent->getNom();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
