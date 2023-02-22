<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{
    #[Route('/personne', name: 'personne.list')]
    public function index(ManagerRegistry $doctrine): Response
    {   
        $repository=$doctrine->getRepository(persistentObject:Personne::class);
        $personnes=$repository->findAll();
        return $this->render('personne/index.html.twig', [
            'controller_name' => 'PersonneController',
            'personnes'=>$personnes
        ]);
    }
    #[Route(path:'/personne/add/', name:'personne.add')]
    public function addPersonne(ManagerRegistry $doctrine):Response
    {
        $entityManager = $doctrine->getManager();

        $personne = new Personne();
        $personne->setFirstname(firstname:'Jean');
        $personne->setName(name:'Bizance');
        $personne->setAge(age:22);

        $entityManager->persist($personne);
        if($entityManager->flush()){
            $this->addFlash(
                type:'success',
                message:'la personne a'.$personne->getName().' été créé');
        }

        return $this->render(view:'personne/addpersonne.html.twig', parameters: array('personne' => $personne));
    }
}
