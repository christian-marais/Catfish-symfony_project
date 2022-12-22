<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    #[Route('/todo', name: 'todo')]
    public function index(Request $request): Response
    {   
        $session = $request->getSession();
        if(!$session->has('todos')){
            $todos = array(
                'achat'=>'acheter une clé uSB',
                'vendre'=>'revendre la clé'
            );
            $session->set('todos',$todos);
            $this->addFlash('info','la liste vient d\'initialisée');
        }
        
        //on va afficher notre tableau todo
        //si j'ai mon tableau de todo dans ma session je l'affiche
        //sinon je l'initialise puis j'affiche

        return $this->render('todo/index.html.twig', [
            'controller_name' => 'TodoController',
        ]);
    }

    #[Route('/todo/{name}/{content}', name: 'todo.add')]
    public function addToDo(Request $request,$name,$content): Response
    {   
        $session = $request->getSession();
        //verfier si j'ai mon tableau de todo dans la session
            //si oui

            //si non
            //afficher une erreur et on va rediriger
        if($session->has('todos')){

        }else{
            // si non
            // afficher un message d'erreur 
        }
       // return $this->redirectToRoute('todo')
        //on va afficher notre tableau todo
        //si j'ai mon tableau de todo dans ma session je l'affiche
        //sinon je l'initialise puis j'affiche

        return $this->render('todo/index.html.twig', [
            'controller_name' => 'TodoController',
            'name'=>$name,
            'content'=>$content
        ]);
    }
}
