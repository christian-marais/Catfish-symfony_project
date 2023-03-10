<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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
            'personnes'=>$personnes,
            'isPaginated'=>false
        ]);
    }

    #[Route('/personne/filter/age/{ageMin}/{ageMax}', name: 'personne.list.age')]
    public function findPersonneByAge(ManagerRegistry $doctrine,$ageMin,$ageMax): Response
    {   
        $repository=$doctrine->getRepository(persistentObject:Personne::class);
        $personnes=$repository->findByAgeInterval($ageMin,$ageMax);
        return $this->render('personne/index.html.twig', [
            'controller_name' => 'PersonneController',
            'personnes'=>$personnes,
            'isPaginated'=>false
        ]);
    }

    #[Route('/personne/stats/age/{ageMin}/{ageMax}', name: 'personne.list.stats.age')]
    public function statsPersonneByAge(ManagerRegistry $doctrine,$ageMin,$ageMax): Response
    {   
        $repository=$doctrine->getRepository(persistentObject:Personne::class);
        $stats=$repository->statsByAgeInterval($ageMin,$ageMax);
        return $this->render('personne/statsAge.html.twig', [
            'controller_name' => 'PersonneController',
            'statsAge'=>$stats[0],
            'ageMin'=>$ageMin,
            'ageMax'=>$ageMax,
            'isPaginated'=>false
        ]);
    }

    #[Route('/personne/alls/{page<\d+>?1}/{nb<\d+>?12}', name: 'personne.list.alls')]
    public function indexAlls(ManagerRegistry $doctrine,$page,$nb): Response
    {   
        $repository=$doctrine->getRepository(persistentObject:Personne::class);
        $personnes=$repository->findBy([],['age'=>'ASC'],$nb,($page -1) * $nb);
        $nbPersonnes=$repository->count([]);
        $nbPages=ceil($nbPersonnes/$nb);
    
        return $this->render('personne/index.html.twig', [
            'controller_name' => 'PersonneController',
            'personnes'=>$personnes,
            'isPaginated'=>true,
            'nbPages'=>$nbPages,
            'page'=>$page,
            'nb'=>$nb
        ]);
    }
    #[Route('/personne/delete/{id}', name: 'personne.delete')]
    public function delete(ManagerRegistry $doctrine,Personne $personne = null): RedirectResponse
    {   
        if($personne){
            $entityManager=$doctrine->getManager();
            $entityManager->remove($personne);
            $entityManager->flush();
            $this->addFlash(
                type:'success',
                message: 'La personne '. $personne->getName() .' has been deleted'
            );
        }else{
            $this->addFlash(
                type:'error',
                message: "la personne n'a pas ??t?? trouv??e"
            );
        }
        return $this->redirectToRoute('personne.list');
        
    }

    #[Route('/personne/update/{id}/{name}/{firstname}/{age}', name: 'personne.update')]
    public function update(ManagerRegistry $doctrine,Personne $personne = null,$name,$firstname,$age): RedirectResponse
    {   
        if($personne){
            $personne->setFirstname($name);
            $personne->setName($firstname);
            $personne->setAge($age);
            $entityManager=$doctrine->getManager();
            $entityManager->persist($personne);
            $entityManager->flush();
            $this->addFlash(
                type:'success',
                message: 'La personne'. $personne->getName() .'a ??t?? mise ?? jour avec succ??s'
            );
        }else{
            $this->addFlash(
                type:'error',
                message: "la personne n'a pas ??t?? trouv??e"
            );
        }
        return $this->redirectToRoute('personne.list');
        
    }
    
    #[Route('/personne/{id<\d+>?1}', name: 'personne.detail')]
    public function PersonneDetail(Personne $personne = null,$id): mixed
    {   
        // $repository=$doctrine->getRepository(persistentObject:Personne::class);
        // $personne=$repository->find($id);
        if(!$personne||$personne==null){
            $this->addFlash(
                type:'error',
                message:"La personne avec l'id $id n'existe pas."
            );
        return $this->redirectToRoute(route:'personne.list');
        }

        return $this->render('personne/personnedetail.html.twig', [
            'controller_name' => 'PersonneController',
            'personne'=>$personne
        ]);
    }
    #[Route(path:'/personne/edit/{id?0}', name:'personne.edit')]
    public function editPersonne(Personne $personne = null,ManagerRegistry $doctrine, Request $request):mixed
    {   
        $new=false;
        if(!$personne){
            $new=true;
            $personne = new Personne();
        }
        $form = $this->createForm(PersonneType::class, $personne);
        $form->remove(name:'createdAt');
        $form->remove(name:'updatedAt');
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $entityManager = $doctrine->getManager();
            $entityManager->persist($personne);
            $entityManager->flush();
            if($new){
                $message = '??dit??';
            }else{
                $message = 'ajout??';
            }
            $this->addFlash(
            type:'success',
            message:'La personne '.$personne->getName().' '.$personne->getFirstname().'a ??t?? '.$message.' avec succ??s');
            return $this->redirectToRoute('personne.list');
        }else{

        }
        
        // $personne->setFirstname(firstname:'Jean');
        // $personne->setName(name:'Bizance');
        // $personne->setAge(age:22);

        // $entityManager->persist($personne);
        // if($entityManager->flush()){
        //     $this->addFlash(
        //         type:'success',
        //         message:'la personne a'.$personne->getName().' ??t?? cr????');
        // }

        return $this->render(
            view:'personne/addpersonne.html.twig',
            parameters:['form'=>$form->createView(),'new'=>$new]
        );
    }
}
