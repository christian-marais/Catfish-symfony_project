<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'session')]
    public function index(Request $request): Response
    {   
        $nbreVisite=0;
        $session=$request->getSession();
        if($session->has('nbreVisite')){
            $nbreVisite=$session->get('nbreVisite') + 1;
           
        }else{
            $nbreVisite = 1;
        }
        $session->set('nbreVisite',$nbreVisite);
        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
            'nbreVisite'=>$nbreVisite
        ]);
    }
}
