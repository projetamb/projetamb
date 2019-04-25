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
        $files->setTitle("Formulaire d'inscription Krav");
        $files->setLink("formulaire d'inscription Krav.pdf" );
        $files->setSize("338 Ko");
        $files->setDiscipline("Krav maga");
        $manager->persist($files);

        $files = new Files();
        $files->setTitle("Formulaire d'inscription Taekwondo");
        $files->setLink("formulaire d'inscription Taekwondo.pdf" );
        $files->setSize("338 Ko");
        $files->setDiscipline("Taekwondo");
        $manager->persist($files);

        $files = new Files();
        $files->setTitle("Cahier technique");
        $files->setLink("cahier technique.pdf" );
        $files->setSize("974 Ko");
        $files->setDiscipline("Krav maga");
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
        $files->setTitle("Stats sur les agressions nationales");
        $files->setLink("stats sur les agressions nationales.pdf" );
        $files->setSize("151 Ko");
        $files->setDiscipline("Krav maga");
        $manager->persist($files);

        $files = new Files();
        $files->setTitle("Ceinture bleue");
        $files->setLink("ceinture bleue.pdf" );
        $files->setSize("118 Ko");
        $files->setDiscipline("Krav maga");
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

        // table Events
        $event = new Events();
        $event->setTitle("Stage Krav maga");
        $event->setPlace("45 Rue Gabriel Péri 59480 La Bassée");
        $event->setDate($faker->dateTime);
        $event->setDescription("Initiation au Krav maga");
        $event->setOrganisator("Vincent Robin");
        $event->setSubscribeNumber("10");
        $event->setPhoto("stage 1.jpg");
        $event->setEmailContact("artsmartiauxbasseens@gmail.com");
        $event->setPhoneContact("0613822987");
        $manager->persist($event);

        $event = new Events();
        $event->setTitle("Stage Taekwondo");
        $event->setPlace("45 Rue Gabriel Péri 59480 La Bassée");
        $event->setDate($faker->dateTime);
        $event->setDescription("stage avec Franck Dominé");
        $event->setOrganisator("Vincent Robin");
        $event->setSubscribeNumber("10");
        $event->setPhoto("stage avec franck dominé.jpg");
        $event->setEmailContact("artsmartiauxbasseens@gmail.com");
        $event->setPhoneContact("0613822987");
        $manager->persist($event);


        $event = new Events();
        $event->setTitle("Remise de diplôme");
        $event->setPlace("45 Rue Gabriel Péri 59480 La Bassée");
        $event->setDate($faker->dateTime);
        $event->setDescription("Venez assister à la remise des diplômes ");
        $event->setOrganisator("Vincent Robin");
        $event->setSubscribeNumber("10");
        $event->setPhoto("sabre.jpg");
        $event->setEmailContact("artsmartiauxbasseens@gmail.com");
        $event->setPhoneContact("0613822987");
        $manager->persist($event);

        $event = new Events();
        $event->setTitle("Stage Krav maga");
        $event->setPlace("45 Rue Gabriel Péri 59480 La Bassée");
        $event->setDate($faker->dateTime);
        $event->setDescription("stage avec Gilles");
        $event->setOrganisator("Vincent Robin");
        $event->setSubscribeNumber("10");
        $event->setPhoto("stage avec gilles.jpg");
        $event->setEmailContact("artsmartiauxbasseens@gmail.com");
        $event->setPhoneContact("0613822987");
        $manager->persist($event);

        $event = new Events();
        $event->setTitle("Stage de perfectionnement");
        $event->setPlace("45 Rue Gabriel Péri 59480 La Bassée");
        $event->setDate($faker->dateTime);
        $event->setDescription("stage de perfectionnement technique, stratégie de combat et self défense, avec la participation de Mikael Meloul");
        $event->setOrganisator("Vincent Robin");
        $event->setSubscribeNumber("10");
        $event->setPhoto("mickael melloul.jpg");
        $event->setEmailContact("artsmartiauxbasseens@gmail.com");
        $event->setPhoneContact("0613822987");
        $manager->persist($event);

        $event = new Events();
        $event->setTitle("Stage privé");
        $event->setPlace("45 Rue Gabriel Péri 59480 La Bassée");
        $event->setDate($faker->dateTime);
        $event->setDescription("stage privé avec Vincent Robin");
        $event->setOrganisator("Vincent Robin");
        $event->setSubscribeNumber("10");
        $event->setPhoto("tkdvincent.jpg");
        $event->setEmailContact("artsmartiauxbasseens@gmail.com");
        $event->setPhoneContact("0613822987");
        $manager->persist($event);

        // table Personnal
        $personnal = new Personnal();
        $personnal->setLastName("Robin");
        $personnal->setFirstName("Vincent");
        $personnal->setEmail("v.robin59@gmail.com");
        $personnal->setPhone("0613822987");
        $personnal->setAddress("45 Rue Gabriel Péri 59480 La Bassée");
        $personnal->setRole('Instructeur');
        $personnal->setGrade("Ceinture Noire");
        $personnal->setDescription("Très bon instructeur, serviable");
        $personnal->setLink($faker->url);
        $personnal->setPhoto("vincent.jpg");
        $manager->persist($personnal);

        $personnal = new Personnal();
        $personnal->setLastName("Moniez");
        $personnal->setFirstName("Geoffrey");
        $personnal->setEmail("moniez.geoffrey@yahoo.fr");
        $personnal->setPhone("0632659980");
        $personnal->setAddress("45 Rue Gabriel Péri 59480 La Bassée");
        $personnal->setRole('Instructeur');
        $personnal->setGrade("Ceinture blanche");
        $personnal->setDescription("Très bon instructeur, serviable");
        $personnal->setLink($faker->url);
        $personnal->setPhoto("geoffrey.jpg");
        $manager->persist($personnal);

        $personnal = new Personnal();
        $personnal->setLastName("Gagneur");
        $personnal->setFirstName("Laurent");
        $personnal->setEmail("l.gagneur@free.fr");
        $personnal->setPhone("0783979809");
        $personnal->setAddress("45 Rue Gabriel Péri 59480 La Bassée");
        $personnal->setRole('Instructeur');
        $personnal->setGrade("Ceinture rouge");
        $personnal->setDescription("Très bon instructeur, serviable");
        $personnal->setLink($faker->url);
        $personnal->setPhoto("laurent.jpg");
        $manager->persist($personnal);

        $personnal = new Personnal();
        $personnal->setLastName("Baratte");
        $personnal->setFirstName("Mélisande");
        $personnal->setEmail("baratte.melisande@gmail.com");
        $personnal->setPhone("0699288706");
        $personnal->setAddress("45 Rue Gabriel Péri 59480 La Bassée");
        $personnal->setRole('Instructeur');
        $personnal->setGrade("Ceinture verte");
        $personnal->setDescription("Très bon instructeur, serviable");
        $personnal->setLink($faker->url);
        $personnal->setPhoto("melisande.jpg");
        $manager->persist($personnal);

        $personnal = new Personnal();
        $personnal->setLastName("Perrault");
        $personnal->setFirstName("Jean");
        $personnal->setEmail("perrault.jean66@gmail.com");
        $personnal->setPhone("0668361441");
        $personnal->setAddress("45 Rue Gabriel Péri 59480 La Bassée");
        $personnal->setRole('Instructeur');
        $personnal->setGrade("Ceinture jaune");
        $personnal->setDescription("Très bon instructeur, serviable");
        $personnal->setLink($faker->url);
        $personnal->setPhoto("jean.jpg");
        $manager->persist($personnal);







        $manager->flush();
    }
}
