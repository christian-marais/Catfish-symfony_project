<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    #[Route('/todo', name: 'app_todo')]
    public function index(Request $request): Response
    {   
        $session = $request->getSession();
        if(!$session->has('todos')){
            $todos = array(
                'achat'=>'acheter une clé uSB',
                'vendre'=>'revendre la clé'
            );
            $session->set('todos',$todos)
        }
        //on va afficher notre tableau todo
        //si j'ai mon tableau de todo dans ma session je l'affiche
        //sinon je l'initialise puis j'affiche

        return $this->render('todo/index.html.twig', [
            'controller_name' => 'TodoController',
        ]);
    }
}
