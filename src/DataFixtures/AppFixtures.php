<?php

namespace App\DataFixtures;

use App\Entity\Personnal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $personnal = [];

        for ($i = 1; $i <= 10; $i++) {
            $personnal = new Personnal();
            $personnal->setLastName($faker->name);
            $personnal->setFirstName($faker->name);
            $personnal->setEmail($faker->name);
            $personnal->setPhone($faker->name);
            $personnal->setAddress($faker->name);
            $personnal->setRole($faker->name);
            $personnal->setGrade($faker->name);
            $personnal->setDescription($faker->name);
            $personnal->setLink($faker->name);
            $manager->persist($personnal);
        }
        // $product = new Product();

        $manager->flush();
    }
}
