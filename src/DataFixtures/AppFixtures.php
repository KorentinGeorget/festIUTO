<?php

namespace App\DataFixtures;

use App\Entity\Evenement;
use App\Entity\Festival;
use App\Entity\Groupe;
use App\Entity\Hebergement;
use App\Entity\Instrument;
use App\Entity\LieuEvent;
use App\Entity\Membre;
use App\Entity\PossedeBillet;
use App\Entity\Spectateur;
use App\Entity\Style;
use App\Entity\TempsTransport;
use App\Entity\TypeBillet;
use App\Entity\TypeEvent;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{

    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {


        

        // Exemple de jeu de données pour TypeBillet
        $typeBillet1 = new TypeBillet();
        $typeBillet1->setTypeBillet('journée');
        $dateTime = new \DateTime();
        $dateTime->modify('+24 hours');
        $typeBillet1->setDureeBillet($dateTime);
        $manager->persist($typeBillet1);

        $typeBillet2 = new TypeBillet();
        $typeBillet2->setTypeBillet('2jours');
        $dateTime = new \DateTime();
        $typeBillet2->setDureeBillet($dateTime);
        $manager->persist($typeBillet2);

        $typeBillet3 = new TypeBillet();
        $typeBillet3->setTypeBillet('totalité');
        $dateInterval = new \DateInterval('P7D'); 
        $dateTime = new \DateTime();
        $typeBillet3->setDureeBillet($dateTime);
        $manager->persist($typeBillet3);

        $manager->flush();




        // Exemple de jeu de données pour PossedeBillet

        $spectateurs = new ArrayCollection();
        for ($i = 0; $i < 80; $i++) {
            $nom = $this->faker->lastName;
            $prenom = $this->faker->firstName;
            $spectateur = new Spectateur();
            $spectateur->setPrenom($prenom)
                ->setNom($nom);
            $manager->persist($spectateur);

            $possedeBillet = new PossedeBillet();
            $possedeBillet->setSpectateur($spectateur)
                ->setBillet($this->faker->randomElement([$typeBillet1,$typeBillet2,$typeBillet3]));
            $dateObtention = new \DateTime();
            $possedeBillet->setDateObtention($dateObtention);

            $spectateur->addBillet($possedeBillet);
            $spectateurs->add($spectateur);
            $manager->persist($spectateur);
            $manager->persist($possedeBillet);

                    //Users 

            $user = new User();
            $user->setEmail($this->faker->email)
                ->setRoles(['ROLE_USER','ROLE_SPECTATEUR'])
                ->setNom($nom)
                ->setPrenom($prenom)
                ->setPlainPassword('password')
                ->setSpectateur($spectateur);


            $manager->persist($user);
        }

        // Exemple de jeu de données pour TypeEvent

        $typeEvent1 = new TypeEvent();
        $typeEvent1->setTypeEvent('Concert')
            ->setIsPublic($this->faker->boolean);
        $manager->persist($typeEvent1);

        $typeEvent2 = new TypeEvent();
        $typeEvent2->setTypeEvent('Evenement')
            ->setIsPublic($this->faker->boolean);
        $manager->persist($typeEvent2);

        $typeEvent3 = new TypeEvent();
        $typeEvent3->setTypeEvent('plateau radio')
            ->setIsPublic($this->faker->boolean);
        $manager->persist($typeEvent3);
        

        // Exemple de jeu de données pour LieuEvent

        $lieux = new ArrayCollection();
        for ($i = 0; $i < 10; $i++) {

            $lieuEvent = new LieuEvent();
            $lieuEvent->setNomLieu($this->faker->city)
                ->setAdresse($this->faker->address)
                ->setNombrePlaceLieu($this->faker->numberBetween(100, 1000));  
            $lieux->add($lieuEvent);
            $manager->persist($lieuEvent);
        }

        // Exemple de jeu de données pour TempsTransport

        $lieuxArray = $lieux->toArray();
        foreach ($lieuxArray as $lieu1) {
            foreach ($lieuxArray as $lieu2) {
                if ($lieu1 !== $lieu2) {
                    $tempsTransport = new TempsTransport();
                    $tempsTransport->setLieu1($lieu1)
                        ->setLieu2($lieu2)
                        ->setTemps($this->faker->dateTimeBetween('00:00:00', '01:00:00'));
                    $lieu1->addTempsTransport($tempsTransport);
                    $manager->persist($tempsTransport);
                }
            }
            $manager->persist($lieu1);
        }




        // Exemple de jeu de données pour Instrument

        $instruments = new ArrayCollection();
        for ($i = 0; $i < 10; $i++) {
            $instrument = new Instrument();
            $instrument->setNomInstrument($this->faker->randomElement(['Guitare', 'Basse', 'Batterie', 'Piano', 'Violon', 'Violoncelle', 'Trompette', 'Saxophone', 'Flûte', 'Harpe', 'Trombone', 'Tuba', 'Contrebasse', 'Accordéon', 'Orgue', 'Synthétiseur', 'Clarinette', 'Hautbois', 'Cor', 'Basson', 'Harmonica', 'Triangle', 'Cymbales', 'Maracas', 'Tambour', 'Xylophone', 'Glockenspiel', 'Caisse claire', 'Timbales', 'Caisse claire', 'Cymbales', 'Tambour', 'Xylophone', 'Glockenspiel', 'Caisse claire', 'Timbales', 'Caisse claire', 'Cymbales', 'Tambour', 'Xylophone', 'Glockenspiel', 'Caisse claire', 'Timbales', 'Caisse claire', 'Cymbales', 'Tambour', 'Xylophone', 'Glockenspiel', 'Caisse claire', 'Timbales', 'Caisse claire', 'Cymbales', 'Tambour', 'Xylophone', 'Glockenspiel', 'Caisse claire', 'Timbales', 'Caisse claire', 'Cymbales', 'Tambour', 'Xylophone', 'Glockenspiel', 'Caisse claire', 'Timbales', 'Caisse claire', 'Cymbales', 'Tambour', 'Xylophone', 'Glockenspiel', 'Caisse claire', 'Timbales', 'Caisse claire', 'Cymbales', 'Tambour', 'Xylophone', 'Glockenspiel', 'Caisse claire', 'Timbales', 'Caisse claire', 'Cymbales', 'Tambour', 'Xylophone', 'Glockenspiel']));
            $instruments->add($instrument);
            $manager->persist($instrument);
        }

        // Exemple de jeu de données pour Membres

        $membres = new ArrayCollection();
        for($i = 0; $i < 80; $i++){
            $nom = $this->faker->lastName;
            $prenom = $this->faker->firstName;
            $membre = new Membre();
            $membre->setNom($nom)
                ->setPrenom($prenom);
            // Exemple de jeu de données pour membre possede un/des instrument(s)
            $nbMembres = $this->faker->numberBetween(1, 3);
            for ($j = 0; $j < $nbMembres; $j++) {
                $membre->addInstrument($this->faker->randomElement($instruments));
            }
            $membres->add($membre);
            $manager->persist($membre);


            $user = new User();
            $user->setEmail($this->faker->email)
                ->setRoles(['ROLE_USER','ROLE_MEMBRE'])
                ->setNom($nom)
                ->setPrenom($prenom)
                ->setPlainPassword('password')
                ->setMembre($membre);

            $manager->persist($user);
        }

       
        // Exemple de jeu de données pour Hebergement

        $hebergements = new ArrayCollection();
        for($i = 0; $i < 10; $i++){
            $hebergement = new Hebergement();
            $hebergement->setNomHebergement($this->faker->word)
                ->setAdresse($this->faker->address)
                ->setNbPlaceHebergement($this->faker->numberBetween(100, 1000));
            $hebergements->add($hebergement);
            $manager->persist($hebergement);
        }

        // Exemple de jeu de données pour Style

        $styles = new ArrayCollection();
        for($i = 0; $i < 10; $i++){
            $style = new Style();
            $style->setNomStyle($this->faker->randomElement(['Rock', 'Pop', 'Jazz', 'Classique', 'Rap', 'RnB', 'Reggae', 'Metal', 'Country', 'Folk', 'Blues', 'Soul', 'Funk', 'Disco', 'Techno', 'House', 'Electro', 'Ambient', 'Dubstep', 'Drum and bass', 'Trance', 'Hardcore', 'Gospel', 'Latino', 'Salsa', 'Samba', 'Tango', 'Flamenco', 'Fado', 'Bossa nova', 'Afrobeat', 'Raï', 'Raeggaton', 'Zouk', 'Kizomba', 'Cumbia', 'Merengue', 'Bachata', 'Vallenato', 'Tango', 'Fado', 'Bossa nova', 'Afrobeat', 'Raï', 'Raeggaton', 'Zouk', 'Kizomba', 'Cumbia', 'Merengue', 'Bachata', 'Vallenato', 'Tango', 'Fado', 'Bossa nova', 'Afrobeat', 'Raï', 'Raeggaton', 'Zouk', 'Kizomba', 'Cumbia', 'Merengue', 'Bachata', 'Vallenato', 'Tango', 'Fado', 'Bossa nova', 'Afrobeat', 'Raï', 'Raeggaton', 'Zouk', 'Kizomba', 'Cumbia', 'Merengue', 'Bachata', 'Vallenato', 'Tango', 'Fado', 'Bossa nova', 'Afrobeat', 'Raï', 'Raeggaton', 'Zouk', 'Kizomba', 'Cumbia', 'Merengue', 'Bachata', 'Vallenato']));
            // Exemple de jeu de données pour style a un/des style(s) similaire(s)
            $nbStyles = $this->faker->numberBetween(1, 2);
            for ($j = 0; $j < $nbStyles; $j++) {
                if($i!=0){
                    $style->addStyleSimilaire($this->faker->randomElement($styles));
                }
            }
            $styles->add($style);
            $manager->persist($style);
        }

        // Exemple de jeu de données pour Groupe

        $groupes = new ArrayCollection();
        for($i = 0; $i < 20; $i++){
            $groupe = new Groupe();
            $groupe->setNomGroupe($this->faker->word);
            // Exemple de jeu de données pour groupe possede un/des hebergement(s)
            $nbHebergements = $this->faker->numberBetween(1, 2);
            for ($j = 0; $j < $nbHebergements; $j++) {
                $groupe->addHebergement($this->faker->randomElement($hebergements));
            }
            // Exemple de jeu de données pour groupe possede un/des style(s)
            $nbStyles = $this->faker->numberBetween(1, 5);
            for ($j = 0; $j < $nbStyles; $j++) {
                $groupe->addStyle($this->faker->randomElement($styles));
            }
            $groupes->add($groupe);
            $manager->persist($groupe);
        }

        foreach($membres as $membre){
            $membre->setGroupe($this->faker->randomElement($groupes));
            $manager->persist($membre);
        }
       

        // Exemple de jeu de données pour Evenement et festivals

        for($j =0; $j<3; $j++){
            $evenements = new ArrayCollection();
            $startDate = $this->faker->dateTimeBetween('now', '+1 years');
            $endDate = clone $startDate;
            $endDate->add(new \DateInterval('P10D'));
            for ($i = 0; $i < 20; $i++) {
                $evenement = new Evenement();
                $evenement->setNom($this->faker->word)
                    ->setDateEv($this->faker->dateTimeBetween($startDate, $endDate))
                    ->setHeureDebut($this->faker->dateTimeBetween('00:00:00', '23:59:59'))
                    ->setTempsMontage($this->faker->dateTimeBetween('00:00:00', '1:00:00'))
                    ->setDureeEv($this->faker->dateTimeBetween('00:00:00', '23:59:59'))
                    ->setTempsDemontage($this->faker->dateTimeBetween('00:00:00', '1:00:00'))
                    ->setTypeEvent($this->faker->randomElement([$typeEvent1, $typeEvent2, $typeEvent3]))
                    ->setLieuEvent($this->faker->randomElement($lieux))
                    ->setGroupe($this->faker->randomElement($groupes))
                    ->setIsPayant($this->faker->boolean);
                $evenements->add($evenement);
                $manager->persist($evenement);
            }

            $festival = new Festival();
            $festival->setNom($this->faker->word)
                ->setDescription($this->faker->text)
                ->setDateDebut(DateTimeImmutable::createFromMutable($startDate))
                ->setDateFin(DateTimeImmutable::createFromMutable($endDate));
            foreach($evenements as $evenement){
                $festival->addEvenement($evenement);
            }
            $manager->persist($festival);
        }

        foreach($spectateurs as $spectateur){
            // Exemple de jeu de données pour spectateur assiste à plusieurs événements
            $nbEvenements = $this->faker->numberBetween(1, 5);
            for ($j = 0; $j < $nbEvenements; $j++) {
                $spectateur->addEvenement($this->faker->randomElement($evenements));
            }

            // Exemple de jeu de données pour spectateur a un/des groupe(s) favori(s)

            $nbGroupes = $this->faker->numberBetween(1, 3);
            for ($j = 0; $j < $nbGroupes; $j++) {
                $spectateur->addGroupeFavori($this->faker->randomElement($groupes));
            }

            $manager->persist($spectateur);
        }

        // 2 USER ADMIN

        for($i = 0; $i < 2; $i++){
            $user = new User();
            $user->setEmail($this->faker->email)
                ->setRoles(['ROLE_USER','ROLE_ADMIN'])
                ->setNom($this->faker->lastName)
                ->setPrenom($this->faker->firstName)
                ->setPlainPassword('admin');
            $manager->persist($user);
        }


        // USER TEST FIXE

        $user = new User();
        $user->setEmail("admin@gmail.com")
            ->setRoles(['ROLE_USER','ROLE_ADMIN'])
            ->setNom("Doe")
            ->setPrenom("John")
            ->setPlainPassword('password');
        $manager->persist($user);


        $spectateur = new Spectateur();
        $spectateur->setNom("Marechal")
            ->setPrenom("Roger")
            ->addGroupeFavori($this->faker->randomElement($groupes))
            ->addGroupeFavori($this->faker->randomElement($groupes))
            ->addEvenement($this->faker->randomElement($evenements))
            ->addEvenement($this->faker->randomElement($evenements))
            ->addEvenement($this->faker->randomElement($evenements));

        $possedeBillet = new PossedeBillet();
        $possedeBillet->setSpectateur($spectateur)
            ->setBillet($this->faker->randomElement([$typeBillet1,$typeBillet2,$typeBillet3]));
        $dateObtention = new \DateTime();
        $possedeBillet->setDateObtention($dateObtention);
        $manager->persist($possedeBillet);

        $spectateur->addBillet($possedeBillet);
        $manager->persist($spectateur);

        $user = new User();
        $user->setEmail("spectateur@gmail.com")
            ->setRoles(['ROLE_USER','ROLE_SPECTATEUR'])
            ->setNom("Marechal")
            ->setPrenom("Roger")
            ->setPlainPassword('password')
            ->setSpectateur($spectateur);
        $manager->persist($user);


        $membre = new Membre();
        $membre->setNom("Dias")
            ->setPrenom("Noemie")
            ->setGroupe($this->faker->randomElement($groupes))
            ->addInstrument($this->faker->randomElement($instruments))
            ->addInstrument($this->faker->randomElement($instruments))
            ->setGroupe($this->faker->randomElement($groupes));
        $manager->persist($membre);

        $user = new User();
        $user->setEmail("membre@gmail.com")
            ->setRoles(['ROLE_USER','ROLE_MEMBRE'])
            ->setNom("Dias")
            ->setPrenom("Noemie")
            ->setPlainPassword('password')
            ->setMembre($membre);
        $manager->persist($user);

        $manager->flush();


    }
}