<?php

namespace App\Form;

use App\Entity\Artiste;
use App\Entity\Lieu;
use App\Entity\Oeuvre;
use App\Entity\Technique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OeuvreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('dateCreation')
            ->add('description')
            ->add('dateDestruction')
            ->add('lieu', EntityType::class, [
                'class' => Lieu::class,
                'choice_label' => 'adresse',
            ])
            ->add('artistes', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'pseudonyme',
                'multiple' => true,
            ])
            ->add('techniques', EntityType::class, [
                'class' => Technique::class,
                'choice_label' => 'nom',
                'multiple' => true,
            ])
            ->add('recouvre', EntityType::class, [
                'class' => Oeuvre::class,
                'choice_label' => 'titre',
                'required' => false,
            ])
            ->add('recouvertPar', EntityType::class, [
                'class' => Oeuvre::class,
                'choice_label' => 'titre',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Oeuvre::class,
        ]);
    }
}
