<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]// #[Route est un attribut accessible à partir de la version 8 de php, voir que composer possède bien la version 8 de php
    public function index(): Response // symfony a partir d'une requete envoie une réponse, la fonction retourne une réponse
    {  
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
    #[Route('/sayhello/{name}/{prenom}', name: 'hello')]// #[Route est un attribut accessible à partir de la version 8 de php, voir que composer possède bien la version 8 de php
    public function hello($name,$prenom): Response // symfony a partir d'une requete envoie une réponse, la fonction retourne une réponse
    {  
        return $this->render('first/hello.html.twig', [
            'nom'=>$name,'prenom'=>$prenom
        ]);
    }
}
