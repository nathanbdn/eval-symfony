<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class BenevoleFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['benevoles'];
    }

    public function load(ObjectManager $manager): void
    {
        $benevole = (new User())
            ->setEmail('marie@example.com')
            ->setNom('Dupont')
            ->setPrenom('Marie');
        $manager->persist($benevole);

        $manager->flush();
    }
}
