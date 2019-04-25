<?php

namespace App\DataFixtures;

use App\Entity\Events;
use App\Entity\Entity;
use App\Entity\Disciplines;

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
        $entity=[];
        $disciplines=[];

        // table Entity
        $entity = new Entity();
        $entity->setName("Arts Martiaux Basséens");
        $entity->setType("Association sportive");
        $entity->setAdress("45 Rue Gabriel Péri");
        $entity->setPostalcity("59480 La Bassée");
        $entity->setEmail("artsmartiauxbasseens@gmail.com");
        $entity->setDirectorname("Vincent Robin");
        $entity->setDirectorphone("06 13 82 29 87");
        $entity->setDirectoremail("v.robin59@gmail.com");
        $entity->setLogo("logo.png");
        $entity->setDescriptive("Club créé en 2016, dans les Weppes. Pratique du Taekwondo en compétition ou en loisir, ainsi que le Krav maga, système Gilles Grosjean (KM2G). Le Club propose également du sport santé bien-être sur inscription.");
        $entity->setColor("#d7d7d7");
        $entity->setLinkmap("https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2536.089131130008!2d2.812029415158197!3d50.53251288933042!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47dd2f6e367cfde1%3A0x9f8d2c62c0babb6e!2s45+Rue+Gabriel+P%C3%A9ri%2C+59480+La+Bass%C3%A9e!5e0!3m2!1sfr!2sfr!4v1555422888757!5m2!1sfr!2sfr");
        $entity->setFacebook("https://www.facebook.com/artsmartiauxbasseens/");
        $entity->setLogopage("logo_forClub.png");
        $entity->setPhotobandeau("timothy-eberly-515801-unsplash.jpg");
        $manager->persist($entity);

        // table Disciplines
        $disciplines = new Disciplines();
        $disciplines->setName("Taekwondo");
        $disciplines->setDescription("Le taekwondo est un art martial d'origine sud-coréenne, dont le nom peut se traduire par La voie du pied et du poing.
                    Le taekwondo se distingue des autres arts martiaux, surtout dans sa forme, par le haut degré de spécialisation de ses pratiquants
                    en techniques de coups de pieds bien plus que dans d'autres techniques, par les nombreuses protections utilisées lors des compétitions
                    de combat ainsi que par le fait que, depuis qu'il a été inclus au programme des Jeux olympiques d'été en 2000.");
        $manager->persist($disciplines);

        // table Disciplines
        $disciplines = new Disciplines();
        $disciplines->setName("Krav maga");
        $disciplines->setDescription("Le krav-maga est à l'origine une méthode d'autodéfense d'origine israélo-tchécoslovaque hongroise combinant des techniques provenant de la boxe,
                    du muay-thaï, du judo, du ju-jitsu et de la lutte. Cette méthode, créée par Imi Lichtenfeld, est maintenant une base de l'armée israélienne et
                    des services spéciaux israéliens pour se défendre au corps à corps face aux assaillants. La méthode est utilisée par de nombreux services de police
                    et forces militaires dans le monde tels qu'aux États-Unis le FBI, la DEA, les marines, en France le GIGN, le RAID, la Légion étrangère et au Royaume-Uni les SAS.");
        $manager->persist($disciplines);


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
        $personnal->setFirstName("Mélisande");
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
        $files->setSize("974 Ko");
        $files->setDiscipline("Taekwondo");
        $manager->persist($files);

        $files = new Files();
        $files->setTitle("Passage grade enfant");
        $files->setLink("passage grade enfant.pdf" );
        $files->setSize("540 Ko");
        $files->setDiscipline("Taekwondo");
        $manager->persist($files);

        $files = new Files();
        $files->setTitle("Stats sur les agressions nationales");
        $files->setLink("stats sur les agressions nationales.pdf" );
        $files->setSize("151 Ko");
        $files->setDiscipline("Taekwondo");
        $manager->persist($files);

        $files = new Files();
        $files->setTitle("Formulaire d'inscription");
        $files->setLink("formulaire d'inscription.pdf" );
        $files->setSize("338 Ko");
        $files->setDiscipline("Taekwondo");
        $manager->persist($files);

        $files = new Files();
        $files->setTitle("Ceinture bleue");
        $files->setLink("ceinture bleue.pdf" );
        $files->setSize("118 Ko");
        $files->setDiscipline("Taekwondo");
        $manager->persist($files);

        $files = new Files();
        $files->setTitle("Ceinture jaune");
        $files->setLink("ceinture jaune.pdf" );
        $files->setSize("115 Ko");
        $files->setDiscipline("Krav maga");
        $manager->persist($files);

        $files = new Files();
        $files->setTitle("Ceinture marron");
        $files->setLink("ceinture marron.pdf" );
        $files->setSize("103 Ko");
        $files->setDiscipline("Krav maga");
        $manager->persist($files);

        $files = new Files();
        $files->setTitle("Ceinture orange");
        $files->setLink("ceinture orange.pdf" );
        $files->setSize("119 Ko");
        $files->setDiscipline("Krav maga");
        $manager->persist($files);

        $files = new Files();
        $files->setTitle("Ceinture verte");
        $files->setLink("ceinture verte.pdf" );
        $files->setSize("133 Ko");
        $files->setDiscipline("Krav maga");
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
