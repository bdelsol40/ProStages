<?php
namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Entity\User;


class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {

    // Création de 2 utilisateurs de test
         $patrick = new User();
         $patrick->setPrenom("patrick");
         $patrick->setNom("Etcheverry");
         $patrick->setEmail("patrick@free.fr");
         $patrick->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
         $patrick->setPassword('$2y$10$YrLtwQbYL14ll/bnuMUPsuCe829vprURwPn8qr3YmlBP9ldmKy4uq');
         $manager->persist($patrick);

         $benjamin = new User();
         $benjamin->setPrenom("Benjamin");
         $benjamin->setNom("Delsol");
         $benjamin->setEmail("benjamin@free.fr");
         $benjamin->setRoles(['ROLE_ADMIN']);
         $benjamin->setPassword('$2y$10$SSbKG/SuWxp7btQQA5j0Oul5t4k9WiAq.sDfViLy3TFO9FMcIt17y');
         $manager->persist($benjamin);

    // Création d'un générateur de donnée avec FAKER
    $faker = \Faker\Factory::create('fr_FR');

    //Création des Entreprises
    $nbEntreprises = 10;
    for ($i = 0 ; $i < $nbEntreprises ; $i++ ) {
      $tabEntreprise[$i] = new Entreprise();
      $tabEntreprise[$i]->setNom($faker->company);
      $tabEntreprise[$i]->setActivite($faker->regexify('(Développement|Conception|Agence) (Web|Bases de données|Mobile)'));
      $tabEntreprise[$i]->setAdresse($faker->address);
      $tabEntreprise[$i]->setSiteWeb($faker->domainName);
      $manager->persist($tabEntreprise[$i]);
    }

    //Création des formations et stages
    $listeFormations = array(
      "DUT INFO" => "DUT Informatique",
      "DUT GEA" => "DUT Gestion Entreprises et Administrations",
      "Licence INFO" => "Licence Informatique",
    );
    foreach ($listeFormations as $nomCourt => $nom) {
      // ************* Création d'une nouvelle formation *************
      $formation = new Formation();

      // Définition du nom court de la formation
      $formation->setNomCourt($nomCourt);

      // Définition du nom (long) de la formation
      $formation->setNomLong($nom);
      $manager->persist($formation);

      // Création de plusieurs stages associés à la formation
      $nbStagesAGenerer = $faker->numberBetween($min = 0, $max = 10);
      for ($numStage = 0; $numStage < $nbStagesAGenerer; $numStage++) {
        $stage = new Stage();
        $stage -> setTitre("".$faker->jobTitle);
        $stage -> setEmail($faker->companyEmail);
        $stage -> setDescription($faker->realText($maxNbChars = 1000, $indexSize = 2));
        // Création relation Stage avec Formation
        $stage -> addFormation($formation);
        $numEntreprise = $faker->numberBetween($min = 0, $max = 9);
        // Création relation Stage avec  Entreprise
        $stage -> setEntreprise($tabEntreprise[$numEntreprise]);
        // Création relation Entreprise avec Stage
        $tabEntreprise[$numEntreprise] -> addStage($stage);
        // Persister les objets modifiés
        $manager->persist($stage);
        $manager->persist($tabEntreprise[$numEntreprise]);
      }
    }
    $manager->flush();
  }
}
