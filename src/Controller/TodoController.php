<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    #[Route('/todo', name:'todo')]
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

    #[Route('/todo/add/{name}/{content}', name:'todo.add')]
    public function addToDo(Request $request,$name,$content): Response
    {   
        $session = $request->getSession();

        //verfier si j'ai mon tableau de todo dans la session
        if($session->has(name:'todos')){
            //si oui
            $todos=$session->get('todos');
            
            if(isset($todos[$name])){
                $this->addFlash(type:'error',message:'Le todo d\'id'.$name.' existe déjà dans la liste');
            }else{
                $todos[$name]=$content;
                $session->replace(['todos'=>$todos]);
                $this->addFlash(type:'success',message:"Le todo d'id $name a été ajouté avec succès");
            }
            
        }else{
            $this->$this->addFlash(
               type:'error',
               message:'la liste des todos n\'est pas encore initialisée'
            );
            
        }
        return $this->redirectToRoute(route:'todo');
    }
    #[Route('/todo/reset',name:'todo.reset')]
    public function delete(Request $request){
        $session=$request->getSession();
        if($session->has('todos')){
            $this->addFlash(
                type:'info',
                message:'la todo liste a été reset');
            $session->remove('todos');
        }
        return $this->redirectToRoute(route:'todo');
    }
    #[Route('/todo/delete/{name}',name:'todo.deleteItem')]
    public function deleteItem(Request $request,$name){
        $session=$request->getSession();
        if($session->has('todos')){
                $todos=$session->get('todos');
                unset($todos[$name]);
                $session->set('todos',$todos);
                $this->addFlash(
                    type:'info',
                    message:"le todo id $name a été supprimé");
            }
        return $this->redirectToRoute(route:'todo');
    }
    #[Route('/todo/update/{name}/{content}',name:'todo.update')]
    public function updateItem(Request $request,$name,$content){
        $session=$request->getSession();
        if($session->has('todos')){
            if($name){
                $todos = $session->get('todos');
                $todos[$name]=$content;
                $session->set('todos',$todos);
                $this->addFlash(
                    type:'info',
                    message:'le todo id'.$name.' a été modifié');
            }

        }
        return $this->redirectToRoute(route:'todo');
    }
}
