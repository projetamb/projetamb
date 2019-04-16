<?php

namespace App\DataFixtures;

use App\Entity\Events;
use App\Entity\Files;
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
        $files=[];

        // table Personnal fixe
        $personnal = new Personnal();
        $personnal->setLastName("Robin");
        $personnal->setFirstName("Vincent");
        $personnal->setEmail("vincent@gmail.com");
        $personnal->setPhone("0606060606");
        $personnal->setAddress("76 rue Maurice Bouchery 59000 La Bassée");
        $personnal->setRole("Président");
        $personnal->setGrade("Ceinture Noire");
        $personnal->setDescription("Bel Homme");
        $personnal->setLink("http://gaillard.net/cumque-consectetur-cupiditate-inventore-recusandae-reprehenderit-cumque.html");
        $personnal->setPhoto("vincent.jpg");
        $manager->persist($personnal);

        $personnal = new Personnal();
        $personnal->setLastName("Baratte");
        $personnal->setFirstName("Melisande");
        $personnal->setEmail("melisande@gmail.com");
        $personnal->setPhone("0707070707");
        $personnal->setAddress("76 rue de la poupée qui tousse 59000 La Bassée");
        $personnal->setRole("Secrétaire");
        $personnal->setGrade("Ceinture Rose");
        $personnal->setDescription("Belle Femme");
        $personnal->setLink("http://gaillard.net/cumque-consectetur-cupiditate-inventore-recusandae-reprehenderit-cumque.html");
        $personnal->setPhoto("melisande.jpg");
        $manager->persist($personnal);

        $personnal = new Personnal();
        $personnal->setLastName("Moniez");
        $personnal->setFirstName("Geoffrey");
        $personnal->setEmail("geoffrey@gmail.com");
        $personnal->setPhone("0808080808");
        $personnal->setAddress("69 rue du cul tourné 59000 La Bassée");
        $personnal->setRole("Trésorier");
        $personnal->setGrade("Ceinture Blanche");
        $personnal->setDescription("Bel Homme Aussi");
        $personnal->setLink("http://gaillard.net/cumque-consectetur-cupiditate-inventore-recusandae-reprehenderit-cumque.html");
        $personnal->setPhoto("geoffrey.jpg");
        $manager->persist($personnal);

        // table Files
        $files = new Files();
        $files->setTitle("Cahier technique");
        $files->setLink("cahier technique.pdf" );
        $manager->persist($files);

        $files = new Files();
        $files->setTitle("Passage grade enfant");
        $files->setLink("passage grade enfant.pdf" );
        $manager->persist($files);

        $files = new Files();
        $files->setTitle("Stats sur les agressions nationales");
        $files->setLink("stats sur les agressions nationales.pdf" );
        $manager->persist($files);

        // table Personnal aléatoire
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

            // table utilisators
            $utilisators =new User();
            $utilisators->setEmail($faker->email);
            $utilisators->setUsername($faker->userName);
            $utilisators->setPassword($faker->password);
            $utilisators->setTypeRole($faker->randomElement([
                "ROLE_ADMIN","ROLE_USER","ANONYMOUS"
            ]));
            $manager->persist($utilisators);

            // table Events
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
