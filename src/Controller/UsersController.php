<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    #[Route('/users', name: 'users')]
    public function index(): Response
    {   $users =[
        ['firstname'=> 'Ayem','name'=>'ALDO','age'=>22],
        ['firstname'=> 'Aem','name'=>'ADO','age'=>22],
        ['firstname'=> 'Aym','name'=>'ALO','age'=>22]

    ];
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
            'users'=>$users
        ]);
    }
    #[Route('/users/notes/{nb<\d+>?5}', name: 'users.notes')]
    public function notes($nb): Response
    {
        $notes=[];
        for($i=0;$i<$nb;$i++){
            $notes[$i]=rand(0,20);
        }
        return $this->render('users/notes.html.twig', [
            'controller_name' => 'UsersController',
            'notes'=>$notes
        ]);
    }
}
