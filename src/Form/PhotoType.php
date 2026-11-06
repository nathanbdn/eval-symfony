<?php

namespace App\Form;

use App\Entity\Oeuvre;
use App\Entity\Photo;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class PhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fichier', FileType::class, [
                'label' => 'Photo',
                'mapped' => false,
                'constraints' => [
                    new File(
                        mimeTypesMessage: 'Glissez votre photo !',
                    ),
                ],
            ])
            ->add('datePriseVue', null, [
                'widget' => 'single_text'
            ])
            ->add('etatOeuvre')
            ->add('ooeuvre', EntityType::class, [
                'label' => 'Oeuvre',
                'class' => Oeuvre::class,
                'choice_label' => 'titre',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Photo::class,
        ]);
    }
}
