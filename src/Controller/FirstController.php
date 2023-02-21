<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FirstController extends AbstractController
{  
    #[Route('/first/{nom?first}', name:'first')]// #[Route est un attribut accessible à partir de la version 8 de php, voir que composer possède bien la version 8 de php
    public function index($nom): Response // symfony a partir d'une requete envoie une réponse, la fonction retourne une réponse
    {   
        //die('je suis la requete '.$first);
        //return new Response(content:"<h1>coucou route first".$nom."</h1>");
        return $this->render('first/index.html.twig', [
            'controller_name' => $nom
         ]);
    }
    #[Route('/sayhello/{name?christian}/{firstname?marais}', name: 'say.hello')]// #[Route est un attribut accessible à partir de la version 8 de php, voir que composer possède bien la version 8 de php
    public function sayhello(Request $request ,$name,$firstname): Response // symfony a partir d'une requete envoie une réponse, la fonction retourne une réponse
    {   
       
        $rand= 1;//rand(0,10);
        if($rand >=2){
            
            //return $this->redirectToRoute(route:'first');
            return $this->forward('App\\Controller\\FirstController::index');
            
        }else{
            return $this->render('first/hello.html.twig', [
                'nom'=>$name,
                'prenom'=>$firstname,
                'path'=>'         '
            ]);
        }
      
    }
    public function hello(Request $request,$name,$firstname): Response // symfony a partir d'une requete envoie une réponse, la fonction retourne une réponse
    {   
        return $this->render('first/hellosnippet.html.twig', [
            'nom'=>$name,
            'prenom'=>$firstname
        ]);
    }
    #[Route(
        '/multiply/{entier1?<\d+>2}/{entier2}',
         name: 'multiply',
         requirements:['entier1' =>'\d+','entier2' =>'\d+'])]// #[Route est un attribut accessible à partir de la version 8 de php, voir que composer possède bien la version 8 de php
    public function multiply($entier1,$entier2): Response // symfony a partir d'une requete envoie une réponse, la fonction retourne une réponse
    {   
        $resultat = $entier1 * $entier2;
        return new Response(content:'<h1>'.$resultat.'</h1>');
      
    }
    #[Route(
        '/{entier1}',
         name: 'generique',
         requirements:['entier1' =>'\d+'])]// #[Route est un attribut accessible à partir de la version 8 de php, voir que composer possède bien la version 8 de php
    public function generiqueRoute($entier1): Response // symfony a partir d'une requete envoie une réponse, la fonction retourne une réponse
    {   
        $resultat = $entier1 * 2;
        return new Response(content: '<html><body><h1>'.$resultat.'</h1></body></html>');
    }

    #[Route(
        '/template',
         name: 'template')]// #[Route est un attribut accessible à partir de la version 8 de php, voir que composer possède bien la version 8 de php
    public function template(): Response // symfony a partir d'une requete envoie une réponse, la fonction retourne une réponse
    {   
        return $this->render('template.html.twig');
    }
}
