<?php

declare(strict_types=1);

namespace App\DataFixtures;


use App\Entity\Cell;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CellFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $cell = new Cell();
        $cell->setWeight(0);
        $manager->persist($cell);

        $cell = new Cell();
        $cell->setWeight(20);
        $manager->persist($cell);

        $cell = new Cell();
        $cell->setWeight(100);
        $manager->persist($cell);

        $cell = new Cell();
        $cell->setWeight(45);
        $manager->persist($cell);

        $cell = new Cell();
        $cell->setWeight(70);
        $manager->persist($cell);

        $cell = new Cell();
        $cell->setWeight(15);
        $manager->persist($cell);

        $cell = new Cell();
        $cell->setWeight(140);
        $manager->persist($cell);

        $cell = new Cell();
        $cell->setWeight(20);
        $manager->persist($cell);

        $cell = new Cell();
        $cell->setWeight(20);
        $manager->persist($cell);

        $cell = new Cell();
        $cell->setWeight(140);
        $manager->persist($cell);

        $cell = new Cell();
        $cell->setWeight(45);
        $manager->persist($cell);

        $manager->flush();
    }
}
