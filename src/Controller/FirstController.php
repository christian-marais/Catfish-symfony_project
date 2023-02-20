<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FirstController extends AbstractController
{  
    #[Route('/first/{nom}', name:'first')]// #[Route est un attribut accessible à partir de la version 8 de php, voir que composer possède bien la version 8 de php
    public function index($nom): Response // symfony a partir d'une requete envoie une réponse, la fonction retourne une réponse
    {   
        //die('je suis la requete '.$first);
        //return new Response(content:"<h1>coucou route first".$nom."</h1>");
        return $this->render('first/index.html.twig', [
            'controller_name' => $nom
         ]);
    }
    #[Route('/sayhello/{name}/{firstname}', name: 'say.hello')]// #[Route est un attribut accessible à partir de la version 8 de php, voir que composer possède bien la version 8 de php
    public function hello(Request $request ,$name,$firstname): Response // symfony a partir d'une requete envoie une réponse, la fonction retourne une réponse
    {   
        dd($request->request);
        $rand= 1;//rand(0,10);
        if($rand >=2){
            
            //return $this->redirectToRoute(route:'first');
            return $this->forward('App\\Controller\\FirstController::index');
            
        }else{
            return $this->render('first/hello.html.twig', [
                'nom'=>$name,'prenom'=>$firstname
            ]);
        }
      
    }
}
