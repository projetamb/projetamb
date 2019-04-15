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
            $personnal->setLastName($faker->lastName);
            $personnal->setFirstName($faker->firstName);
            $personnal->setEmail($faker->safeEmail);
            $personnal->setPhone($faker->phoneNumber);
            $personnal->setAddress($faker->address);
            $personnal->setRole($faker->randomElement([
                'Instructeur', 'Membre'
            ]));
            $personnal->setGrade($faker->randomElement([
                'Ceinture Noire', 'Ceinture Blanche'
            ]));
            $personnal->setDescription($faker->text(75));
            $personnal->setLink($faker->url);
            $personnal->setPhoto($faker->imageUrl('260', '260', 'people'));
            $manager->persist($personnal);
        }
        // $product = new Product();

        $manager->flush();
    }
}
