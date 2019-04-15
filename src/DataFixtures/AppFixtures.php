<?php

namespace App\DataFixtures;

use App\Entity\Events;
use App\Entity\Personnal;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $personnal = [];
        $utilisators=[];
        $event=[];

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
                'Ceinture Noire 5ème dan', 'Ceinture Blanche'
            ]));
            $personnal->setDescription($faker->text(75));
            $personnal->setLink($faker->url);
            $personnal->setPhoto($faker->imageUrl('260', '260', 'people'));
            $manager->persist($personnal);
            // table utilisateur
            $utilisators =new User();
            $utilisators->setEmail($faker->email);
            $utilisators->setUsername($faker->userName);
            $utilisators->setPassword($faker->password);
            $utilisators->setTypeRole($faker->randomElement([
                "ROLE_ADMIN","ROLE_USER","ANONYMOUS"
            ]));
            $manager->persist($utilisators);
            $event = new Events();
            $event->setTitle($faker->title);
            $event->setPlace($faker->address);
            $event->setDate($faker->dateTime);
            $event->setDescription($faker->text(50));
            $event->setOrganisator($faker->userName);
            $event->setSubscribeNumber($faker->numberBetween(1,50));
            $event->setPhoto($faker->imageUrl('260', '260', 'sports'));
            $event->setEmailContact($faker->email);
            $event->setPhoneContact($faker->phoneNumber);
            $manager->persist($event);

        }


        // $product = new Product();

        $manager->flush();
    }
}
