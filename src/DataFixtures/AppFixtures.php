<?php

namespace App\DataFixtures;

use App\Entity\Developer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (range(1, 5) as $number) {
            $developer = new Developer();
            $developer
                ->setName('DEV' . $number)
                ->setLevel($number)
                ->setWorkingHours(45)
            ;
            $manager->persist($developer);
        }

        $manager->flush();
    }
}
