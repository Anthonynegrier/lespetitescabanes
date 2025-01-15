<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Creche;
use App\Form\CrecheType;
use App\Form\CrecheModifierType;
use Symfony\Component\Routing\Attribute\Route;

class CrecheController extends AbstractController
{
    #[Route('/creche', name: 'app_creche')]
    public function index(): Response
    {
        return $this->render('creche/index.html.twig', [
            'controller_name' => 'CrecheController',
        ]);
    }


public function lister(ManagerRegistry $doctrine){

    $repository = $doctrine->getRepository(Creche::class);
    $creches= $repository->findAll();

    return $this->render('creche/lister.html.twig', [
        'creches' => $creches,
    ]);	
    
}

public function consulter(ManagerRegistry $doctrine, int $id): Response
    {
        $creches = $doctrine->getRepository(Creche::class)->find($id);
        
        if (!$creches) {
            throw $this->createNotFoundException(
                'Aucune creche trouvée avec le numéro ' . $id
            );
        }
        
        return $this->render('creche/consulter.html.twig', [
            'creche' => $creches,  
        ]);
    }

    public function ajouter(ManagerRegistry $doctrine,Request $request){
        $creches = new Creche();
	$form = $this->createForm(CrecheType::class, $creches);
	$form->handleRequest($request);
 
	if ($form->isSubmitted() && $form->isValid()) {
 
            $creches = $form->getData();
 
            $entityManager = $doctrine->getManager();
            $entityManager->persist($creches);
            $entityManager->flush();
            
   
 
	    return $this->render('creche/consulter.html.twig', ['creche' => $creches,]);
	}
	else
        {
           
           return $this->render('creche/ajouter.html.twig', array('form' => $form->createView(),));
	}
}

public function modifier(ManagerRegistry $doctrine, $id, Request $request){
 
    $creches = $doctrine->getRepository(Creche::class)->find($id);
 
	if (!$creches) {
	    throw $this->createNotFoundException('Aucune creches trouvé avec le numéro '.$id);
	}

	else
	{
            $form = $this->createForm(CrecheModifierType::class, $creches);
            $form->handleRequest($request);
 
            if ($form->isSubmitted() && $form->isValid()) {
 
                 $creches = $form->getData();
                 $entityManager = $doctrine->getManager();
                 $entityManager->persist($creches);
                 $entityManager->flush();
                 return $this->render('creche/consulter.html.twig', ['creche' => $creches,]);
           }
           else{
                return $this->render('creche/modifier.html.twig', array('form' => $form->createView(),));
           }
        }
 }

 public function supprimer(ManagerRegistry $doctrine, int $id): Response
 {
     $creches = $doctrine->getRepository(Creche::class)->find($id);

     if (!$creches) {
         throw $this->createNotFoundException('Aucune creches trouvé avec l\'ID '.$id);
     }

     $entityManager = $doctrine->getManager();
     $entityManager->remove($creches); 
     $entityManager->flush();

     return $this->redirectToRoute('app_creche_lister');
 }
}