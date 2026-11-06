<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Artiste;
use App\Entity\Lieu;
use App\Entity\Oeuvre;
use App\Entity\Technique;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $lieu = (new Lieu())
            ->setNom('Place du Marché')
            ->setAdresse('1 place du Marché')
            ->setQuartier('Centre')
            ->setLatitude('47.2184000')
            ->setLongitude('-1.5536000');
        $manager->persist($lieu);

        $benevole = (new User())
            ->setEmail('marie@example.com')
            ->setNom('Dupont')
            ->setPrenom('Marie');
        $manager->persist($benevole);

        $technique = (new Technique())->setNom('Pochoir');
        $manager->persist($technique);

        $artiste = (new Artiste())->setPseudonyme('Pseudo1');
        $manager->persist($artiste);

        $oeuvre = (new Oeuvre())
            ->setTitre('Le Renard')
            ->setDateCreation(new \DateTime('2023-05-12'))
            ->setLieu($lieu)
            ->addArtiste($artiste)
            ->addTechnique($technique);
        $manager->persist($oeuvre);

        $manager->flush();
    }
}
