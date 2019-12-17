<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Formation;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $formationDUTInformatique= new Formation();
         $formationDUTInformatique->setNomLong("Diplome Universitaire et Technologique en Informatique");
         $formationDUTInformatique->setNomCourt("DUT INFO");
         $manager->persist($formationDUTInformatique);

         $formationLicenceMultimedia= new Formation();
         $formationLicenceMultimedia->setNomLong("Licence Multimedia");
         $formationLicenceMultimedia->setNomCourt("LP Multimedia");
         $manager->persist($formationLicenceMultimedia);

         $formationDUTIC= new Formation();
         $formationDUTIC->setNomLong("Diplome Universitaire en Technologie de l'Information et de la cCommunication");
         $formationDUTIC->setNomCourt("DU TIC");
         $manager->persist($formationDUTIC);

        $manager->flush();
    }
}
