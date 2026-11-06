<?php

namespace App\DataFixtures;

use App\Entity\Artiste;
use App\Entity\Lieu;
use App\Entity\Oeuvre;
use App\Entity\Photo;
use App\Entity\Technique;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        // 1 seul compte utilisateur classique
        $benevole = (new User())
            ->setEmail('demo@art2rue.fr')
            ->setNom('Dupont')
            ->setPrenom('Marie')
            ->setRoles(['ROLE_USER']);

        $benevole->setPassword(
            $this->passwordHasher->hashPassword($benevole, 'Art2Rue2026!')
        );

        $manager->persist($benevole);

        // Lieux
        $lieu1 = (new Lieu())
            ->setNom('Place du Bouffay')
            ->setAdresse('Place du Bouffay, 44000 Nantes')
            ->setQuartier('Bouffay')
            ->setLatitude('47.2156000')
            ->setLongitude('-1.5539000');

        $lieu2 = (new Lieu())
            ->setNom('Le Hangar à Bananes')
            ->setAdresse('21 Quai des Antilles, 44200 Nantes')
            ->setQuartier('Île de Nantes')
            ->setLatitude('47.2008000')
            ->setLongitude('-1.5725000');

        $manager->persist($lieu1);
        $manager->persist($lieu2);

        // Artistes
        $artiste1 = (new Artiste())
            ->setPseudonyme('Mosa')
            ->setNomReel('Alex Martin')
            ->setBio('Artiste urbain spécialisé dans les fresques colorées.')
            ->setNationalite('Française');

        $artiste2 = (new Artiste())
            ->setPseudonyme('Luna')
            ->setNomReel('Camille Bernard')
            ->setBio('Artiste qui mélange illustration et art mural.')
            ->setNationalite('Française');

        $manager->persist($artiste1);
        $manager->persist($artiste2);

        // Techniques
        $technique1 = (new Technique())->setNom('Pochoir');
        $technique2 = (new Technique())->setNom('Aérosol');

        $manager->persist($technique1);
        $manager->persist($technique2);

        // Œuvres
        $oeuvre1 = (new Oeuvre())
            ->setTitre('Le Renard urbain')
            ->setDateCreation(new \DateTime('2023-05-12'))
            ->setDescription('Un renard coloré peint sur un mur du centre-ville.')
            ->setLieu($lieu1)
            ->addArtiste($artiste1)
            ->addTechnique($technique1);

        $oeuvre2 = (new Oeuvre())
            ->setTitre('Regards croisés')
            ->setDateCreation(new \DateTime('2024-03-20'))
            ->setDescription('Une fresque représentant plusieurs visages.')
            ->setLieu($lieu2)
            ->addArtiste($artiste2)
            ->addTechnique($technique2);

        $oeuvre3 = (new Oeuvre())
            ->setTitre('La ville en couleurs')
            ->setDateCreation(new \DateTime('2025-06-08'))
            ->setDescription('Une composition géométrique aux couleurs vives.')
            ->setLieu($lieu1)
            ->addArtiste($artiste1)
            ->addArtiste($artiste2)
            ->addTechnique($technique1)
            ->addTechnique($technique2);

        $manager->persist($oeuvre1);
        $manager->persist($oeuvre2);
        $manager->persist($oeuvre3);

        // Photos : les noms sont des exemples de fichiers à placer dans ton dossier d'images.
        $photo1 = (new Photo())
            ->setDatePriseVue(new \DateTimeImmutable('2025-01-15'))
            ->setNomFichier('renard-urbain.jpg')
            ->setEtatOeuvre('En bon état')
            ->setOoeuvre($oeuvre1)
            ->setBenevole($benevole);

        $photo2 = (new Photo())
            ->setDatePriseVue(new \DateTimeImmutable('2025-02-10'))
            ->setNomFichier('regards-croises.jpg')
            ->setEtatOeuvre('Légèrement dégradée')
            ->setOoeuvre($oeuvre2)
            ->setBenevole($benevole);

        $manager->persist($photo1);
        $manager->persist($photo2);

        $manager->flush();
    }
}
