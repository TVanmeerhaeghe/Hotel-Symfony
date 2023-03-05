<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use App\Entity\EtablissementHotel;
use App\Entity\GerantHotel;
use App\Entity\SuiteHotel;
use App\Entity\Admin;


class AppFixtures extends Fixture
{
    private $userPasswordHasherInterface;

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface)
    {
    $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function loadAdmin(ObjectManager $manager) {
        $admin = new Admin();
        $admin->setUserName('admin');
        $admin->setRoles(['ROLE_ADMIN']);

        $admin->setPassword(
          $this->userPasswordHasherInterface->hashPassword(
            $admin, 'admin'
          )
        );

        $manager->persist($admin);
        $manager->flush();
    }

    public function loadEtablissement(ObjectManager $manager, $faker) {
        for($i=1; $i<=5;$i++) {
            $etablissement = new EtablissementHotel();

            $etablissement->setNom($faker->word());
            $etablissement->setVille($faker->word());
            $etablissement->setAdresse($faker->word());
            $etablissement->setDescription($faker->paragraph());

            $manager->persist($etablissement);
            $this->addReference('etablissement_'.$i, $etablissement);
        }
        $manager->flush();
    }

    public function loadSuite(ObjectManager $manager, $faker) {

        for($i=1; $i<=20;$i++) {
            $suite = new SuiteHotel();
            $currentEtablissement = $this->getReference('etablissement_'.mt_rand(1,5));
            $suite->setEtablissementHotel($currentEtablissement);
            $suite->setTitre($faker->word());
            $suite->setImg($faker->image('public/uploads/img/', 640, 480, '', false));
            $suite->setDescription($faker->paragraph());
            $suite->setPrix(200);
            $suite->setImgGallerie($faker->image('public/uploads/img/', 640, 480, '', false));
            $manager->persist($suite);
        }
        $manager->flush();
    }

    public function loadReservation(ObjectManager $manager, $faker) {

        for($i=1; $i<=5;$i++) {
            $reservation = new Reservation();
            $currentSuite = $this->getReference('suite_'.mt_rand(1,20));
            $reservation->setSuite($currentSuite);
            $suite->setNom($faker->word());
            $reservation->setMail($faker->word());
            $reservation->setTel(5555555);
            $reservation->setDate($faker->date());
            $manager->persist($reservation);
        }
        $manager->flush();
    }

    public function loadGerant(ObjectManager $manager, $faker) {
        for($i=1; $i<=3;$i++) {
            $gerant = new GerantHotel();
            $gerant->setUserName($faker->word());
            $gerant->setRoles(['ROLE_EMPLOYEE']);
            $gerant->setNom($faker->word());
            $gerant->setPrenom($faker->word());
            $gerant->setMail($faker->word());;
            $currentEtablissement = $this->getReference('etablissement_'.mt_rand(1,5));
            $gerant->setEtablissementHotel($currentEtablissement);
            $gerant->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $gerant, 'gerant'
            )
            );

            $manager->persist($gerant);
        }
        $manager->flush();
    }


    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create("fr_FR");

        $this->loadAdmin($manager);
        $this->loadEtablissement($manager, $faker);
        $this->loadSuite($manager,$faker);
        $this->loadGerant($manager,$faker);
    }
}
