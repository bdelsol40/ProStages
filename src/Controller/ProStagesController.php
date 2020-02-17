<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
/*use Symfony\Component\HttpFoundation\Response;*/
use App\Entity\Stage;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Repository\StageRepository;
use App\Repository\FormationRepository;
use App\Repository\EntrepriseRepository;


class ProStagesController extends AbstractController
{
  /**
  * @Route("/", name="proStages_")
  */

  public function indexHome(StageRepository $repositoryStage)
  {

//Récupérer les stages enregistrées en BD
$stages=$repositoryStage->findAll();
    //Envoyer les stages à la vue chargé de les afficher
    return $this->render('pro_stages/indexHome.html.twig',['stages'=>$stages]);
  }



  /**
  * @Route("/entreprises", name="proStages_entreprises")
  */

  public function indexEntreprises(EntrepriseRepository $repositoryEntreprise)
  {
        //Récupérer les entreprises se trouvant dans la base de données
        $entreprises = $repositoryEntreprise->findAll();
        //Envoyer les entreprises à la vue chargé de les afficher
        return $this->render('pro_stages/indexEntreprises.html.twig', ['entreprises'=>$entreprises]);


  }


  /**
  * @Route("/formations", name="proStages_formations")
  */

  public function indexFormations(FormationRepository $repositoryFormation)
  {

            //Récupérer les formations se trouvant dans la base de données
            $formations = $repositoryFormation->findAll();
            //Envoyer les formations à la vue chargé de les afficher
            return $this->render('pro_stages/indexFormations.html.twig', ['formations'=>$formations]);



  }


  /**
  * @Route("/stages/{id}", name="proStages_stages")
  */

  public function indexStages(Stage $stage)
  {
        //Envoyer le stage à la vue chargée de les afficher
        return $this->render('pro_stages/indexStages.html.twig', ['stage'=>$stage]);
  }

  /**
  * @Route("/entreprises/{nom}", name="proStages_stages_entreprise")
  */

  public function indexStagesParEntreprise(StageRepository $repositoryStage, $nom)
  {

    //Récupérer les stages enregistrées en BD
    $stages=$repositoryStage->findByNomEntreprise($nom);
    //Envoyer les stages à la vue chargée de les afficher
    return $this->render('pro_stages/entreprise_stages.html.twig',['stages'=>$stages]);
  }
  /**
  * @Route("/formation/{nom}", name="proStages_stages_formation")
  */
  public function indexStagesParFormation(StageRepository $repositoryStage, $nom)
  {

    //Récupérer les stages enregistrées en BD
    $stages=$repositoryStage->findByFormation($nom);
    //Envoyer les stages à la vue chargée de les afficher
    return $this->render('pro_stages/formation_stages.html.twig',['stages'=>$stages]);

  }
}
