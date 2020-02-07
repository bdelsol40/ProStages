<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
/*use Symfony\Component\HttpFoundation\Response;*/
use App\Entity\Stage;
use App\Entity\Formation;
use App\Entity\Entreprise;


class ProStagesController extends AbstractController
{
  /**
  * @Route("/", name="proStages_")
  */

  public function indexHome()
  {

//Récupérer le repository de l'entité  Stage
$repositoryStage = $this->getDoctrine()->getRepository(Stage::class);
//Récupérer les stages enregistrées en BD
$stages=$repositoryStage->findAll();
    //Envoyer les stages à la vue chargé de les afficher
    return $this->render('pro_stages/indexHome.html.twig',['stages'=>$stages]);


    /*return new Response(
    '<html>
    <body>
    <h1>Bienvenue sur la page d accueil de ProStages</h1>
    </body>
    </html>');*/
  }



  /**
  * @Route("/entreprises", name="proStages_entreprises")
  */

  public function indexEntreprises()
  {     //Récupérer le repository de l'entité entreprise
        $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);
        //Récupérer les entreprises se trouvant dans la base de données
        $entreprises = $repositoryEntreprise->findAll();
        //Envoyer les entreprises à la vue chargé de les afficher
        return $this->render('pro_stages/indexEntreprises.html.twig', ['entreprises'=>$entreprises]);

    /* return new Response(
    '<html>
    <body>
    <h1>Cette page affichera la liste des entreprises proposant un stage</h1>
    </body>
    </html>');*/
  }


  /**
  * @Route("/formations", name="proStages_formations")
  */

  public function indexFormations()
  {
            //Récupérer le repository de l'entité formation
            $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class);
            //Récupérer les formations se trouvant dans la base de données
            $formations = $repositoryFormation->findAll();
            //Envoyer les formations à la vue chargé de les afficher
            return $this->render('pro_stages/indexFormations.html.twig', ['formations'=>$formations]);


    /* return new Response(
    '<html>
    <body>
    <h1>Cette page affichera la liste des formations de l IUT</h1>
    </body>
    </html>');*/
  }


  /**
  * @Route("/stages/{id}", name="proStages_stages/{id}")
  */

  public function indexStages($id)
  {     //Récupérer le repository de l'entité stage
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);
        //Récupérer les stages se trouvant dans la base de données
        $stage = $repositoryStage->find($id);
        //Envoyer les stages à la vue chargé de les afficher
        return $this->render('pro_stages/indexStages.html.twig', ['stage'=>$stage]);




    /*return new Response(
    '<html>
    <body>
    <h1>Cette page affichera le descriptif du stage ayant pour identifiant {{id}}</h1>
    </body>
    </html>');*/
  }


  /*public function index()
  {
  return $this->render('pro_stages/index.html.twig', [
  'controller_name' => 'ProStagesController',]);
}*/
}
