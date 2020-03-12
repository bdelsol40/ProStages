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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\EntrepriseType;
use App\Form\StageType;



class ProStagesController extends AbstractController
{
  /**
  * @Route("/", name="proStages_")
  */

  public function indexHome(StageRepository $repositoryStage)
  {

//Récupérer les stages enregistrées en BD
$stages=$repositoryStage->findByStages();
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
      * @Route("/profiler/stages/ajouter", name="proStages_ajoutStage")
      */

     public function ajouterStage(Request $request, ObjectManager $manager)
     {
         //Création d'une entreprise vierge qui sera remplie par le formulaire
         $stage = new Stage();

         //Création du formulaire permettent de saisir une entreprise

         $formulaireStage = $this->createForm(Stagetype::class, $stage);


          $formulaireStage->handleRequest($request);

          if ($formulaireStage->isSubmitted() && $formulaireStage->isValid())
          {

             // Enregistrer la ressource en base de donnéelse
             $manager->persist($stage);
             $manager->flush();

             // Rediriger l'utilisateur vers la page des stages
             return $this->redirectToRoute('home');
          }

         //Création de la représentation graphique du formulaire
         $vueFormulaire = $formulaireStage->createView();

     //Afficher la page présentant le formulaire d'ajout d'une entreprise
     return $this->render('pro_stages/ajoutModifStage.html.twig',['vueFormulaire' => $vueFormulaire, 'action'=>"ajouter"]);
     }


  /**
  * @Route("/stages/modifier/{id}", name="proStages_modifStage")
  */

       public function modifierStage(Request $request, ObjectManager $manager, Stage $stage)
       {

           //Création du formulaire permettent de saisir une entreprise
           $formulaireStage = $this->createForm(Stagetype::class, $stage);


            $formulaireStage->handleRequest($request);

            if ($formulaireStage->isSubmitted() && $formulaireStage->isValid())
            {
               // Enregistrer la ressource en base de donnéelse
               $manager->persist($stage);
               $manager->flush();

               // Rediriger l'utilisateur vers la page des stages
               return $this->redirectToRoute('home');
            }

           //Création de la représentation graphique du formulaire
           $vueFormulaire = $formulaireStage->createView();

       //Afficher la page présentant le formulaire d'ajout d'un stage
       return $this->render('pro_stages/ajoutModifStage.html.twig',['vueFormulaire' => $vueFormulaire,'action'=>"modifier"]);
       }




     /**
     * @Route("/stages/show/{id}", name="proStages_stages")
     */
    public function indexStages(stage $stage)
    {
    // Envoyer les stages récupérés à la vue chargée de les afficher
    return $this->render('pro_stages/indexStages.html.twig',
    ['stage' => $stage]);
    }





  /**
  * @Route("/entreprises/show/{nom}", name="proStages_stages_entreprise")
  */

  public function indexStagesParEntreprise(StageRepository $repositoryStage, $nom)
  {

    //Récupérer les stages enregistrées en BD
    $stages=$repositoryStage->findByNomEntreprise($nom);
    //Envoyer les stages à la vue chargée de les afficher
    return $this->render('pro_stages/indexHome.html.twig',['stages'=>$stages]);
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



  /**
  * @Route("/entreprises/ajouter", name="proStages_ajoutEntreprise")
  */

  public function ajouterEntreprise(Request $request, ObjectManager $manager)
  {

//Création d'une entreprise vierge qui sera remplie par le Formulaire
$entreprise = new Entreprise();

//Création du formlulaire permettant de saisir une entreprises
$formulaireEntreprise = $this->createForm(EntrepriseType::class, $entreprise);

// On demande au formulaire d'analyser la dernière requête Http. Si le tableau POST contenu dans cette requête
//contient des variables nom,activité, adresse,site web alors la méthode handleRequest()
//récupère les valeurs de ces variables et les affecte à l'objet $entreprise

$formulaireEntreprise->handleRequest($request);
if($formulaireEntreprise->isSubmitted() && $formulaireEntreprise ->isValid()){

  //Enregistrer l'entreprise en base de données
$manager->persist($entreprise);
$manager->flush();
  //Rediriger l'utilisateur vers la page des entreprises
  return $this->redirectToRoute('proStages_entreprises');
}
//création de la représentation graphique du formulaire
$vueFormulaire = $formulaireEntreprise->createView();


    //Afficher la page présentant le formulaire d'ajout d'une entreprise
    return $this->render('pro_stages/ajoutModifEntreprise.html.twig',['vueFormulaire' => $vueFormulaire,'action'=>"ajouter"]);
  }



  /**
  * @Route("/entreprises/modifier/{id}", name="proStages_modifEntreprise")
  */

  public function modifierEntreprise(Request $request, ObjectManager $manager, Entreprise $entreprise)
  {


//Création du formlulaire permettant de saisir une entreprises
$formulaireEntreprise = $this->createForm(EntrepriseType::class, $entreprise);


// On demande au formulaire d'analyser la dernière requête Http. Si le tableau POST contenu dans cette requête
//contient des variables nom,activité, adresse,site web alors la méthode handleRequest()
//récupère les valeurs de ces variables et les affecte à l'objet $entreprise
$formulaireEntreprise->handleRequest($request);
if($formulaireEntreprise->isSubmitted()){

  //Enregistrer l'entreprise en base de données
$manager->persist($entreprise);
$manager->flush();
  //Rediriger l'utilisateur vers la page des entreprises
  return $this->redirectToRoute('proStages_entreprises');
}
//création de la représentation graphique du formulaire
$vueFormulaire = $formulaireEntreprise->createView();


    //Afficher la page présentant le formulaire d'ajout d'une entreprise
    return $this->render('pro_stages/ajoutModifEntreprise.html.twig',['vueFormulaire' => $vueFormulaire,'action'=>"modifier"]);
  }


}
