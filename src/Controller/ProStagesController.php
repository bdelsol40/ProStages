<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
/*use Symfony\Component\HttpFoundation\Response;*/

class ProStagesController extends AbstractController
{
    /**
     * @Route("/", name="proStages_")
     */

     public function indexHome()
     {
return $this->render('proStages/indexHome.html.twig');


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
    {


        return $this->render('proStages/indexEntreprises.html.twig');

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
      
      
      
      return $this->render('proStages/indexFormations.html.twig');
      
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
    {
       
       
       return $this->render('proStages/indexStages.html.twig', ['idStage'=>$id]);
       
       
       
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
            'controller_name' => 'ProStagesController',
        ]);
    }*/
}
