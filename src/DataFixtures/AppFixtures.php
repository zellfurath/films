<?php

namespace App\DataFixtures;

use App\Entity\Casting;
use App\Entity\Film;
use App\Entity\Genre;
use App\Entity\Pays;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $userPasswordHasher;

    /**
     * @param UserPasswordHasherInterface $userPasswordHasher
     */
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }


    public function load(ObjectManager $manager): void
    {

        # Ajoute 3 genres
        $genreFantastique = new Genre();
        $genreFantastique->setStyle('Fantastique');
        $manager->persist($genreFantastique);

        $genrePolicier = new Genre();
        $genrePolicier->setStyle('Policier');
        $manager->persist($genrePolicier);

        $genreHorreur = new Genre();
        $genreHorreur->setStyle('Horreur');
        $manager->persist($genreHorreur);

        # AJouter 3 pays
        $paysFrance = new Pays();
        $paysFrance->setNom('France');
        $manager->persist($paysFrance);

        $paysUSA = new Pays();
        $paysUSA->setNom('USA');
        $manager->persist($paysUSA);

        $paysUK = new Pays();
        $paysUK->setNom('UK');
        $manager->persist($paysUK);

        #Ajoute 3 castings
        $casting1 = new Casting();
        $casting1->setNom('Murphy');
        $casting1->setPrenom('Eddy');
        $manager->persist($casting1);

        $casting2 = new Casting();
        $casting2->setNom('Johanson');
        $casting2->setPrenom('Scarlet');
        $manager->persist($casting2);

        $casting3 = new Casting();
        $casting3->setNom('Sy');
        $casting3->setPrenom('Ommar');
        $manager->persist($casting3);

        # Ajouter film

        $f = new Film();
        $f->setNom("Dracula")->setImage("62701fca5f341.jpg")
            ->setPays($paysUSA)->setAnneeSortie(2000)
            ->setDuree(120)->addGenre($genreHorreur)
            ->addActeur($casting1)->addActeur($casting2)
            ->addRealisateur($casting3);
        $manager->persist($f);

        $f = new Film();
        $f->setNom("Schrek")->setImage("627f9f71a2dd6.jpg")
            ->setPays($paysUK)->setAnneeSortie(2003)
            ->setDuree(90)->addGenre($genreFantastique)
            ->addActeur($casting1)->addActeur($casting3)
            ->addRealisateur($casting2);
        $manager->persist($f);

        # Ajouter 1 admin
        $util = new Utilisateur();
        $util->setEmail("admin@gmail.com");
        $util->setRoles(["ROLE_ADMIN"]);
        $util->setPassword(
            $this->userPasswordHasher->hashPassword(
                $util,
                '123456')
        );
        $manager->persist($util);

        $manager->flush();
    }
}
