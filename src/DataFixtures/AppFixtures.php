<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Formation;
use App\Entity\Entreprise;
class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {


    //Création de données de test en dur
    $formationDUTInformatique= new Formation();
    $formationDUTInformatique->setNomLong("Diplome Universitaire et Technologique en Informatique");
    $formationDUTInformatique->setNomCourt("DUT INFO");
    $manager->persist($formationDUTInformatique);

    $formationLicenceMultimedia= new Formation();
    $formationLicenceMultimedia->setNomLong("Licence Multimedia");
    $formationLicenceMultimedia->setNomCourt("LP Multimedia");
    $manager->persist($formationLicenceMultimedia);

    $formationDUTIC= new Formation();
    $formationDUTIC->setNomLong("Diplome Universitaire en Technologie de l'Information et de la Communication");
    $formationDUTIC->setNomCourt("DU TIC");
    $manager->persist($formationDUTIC);

    //Création d'un générateur de données FAKER
    $faker = \Faker\Factory::create('fr_FR');
    //Création de données avec FAKER
    $nbEntreprises=15;
    for($i=1;$i <=$nbEntreprises;$i++){
    $Entreprise1= new Entreprise();
    $Entreprise1->setNom($faker->realText($maxNbChars = 200, $indexSize = 2));
    $Entreprise1->setActivite($faker->regexify('M[1-4][1-2]0[1-7]'));
    $Entreprise1->setAdresse($faker->address);
    $Entreprise1->setSiteWeb($faker->url);
    $manager->persist($Entreprise1);
  }
  //Envoyer les données en  BD
  $manager->flush();
  }
}
