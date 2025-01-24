<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Inscription;
use App\Form\InscriptionType;
use App\Form\InscriptionModifierType;



class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(): Response
    {
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }

    public function lister(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Inscription::class);
        $inscriptions= $repository->findAll();
    
        return $this->render('inscription/lister.html.twig', [
            'inscriptions' => $inscriptions,
        ]);	
        
    }

    public function consulter(ManagerRegistry $doctrine, int $id): Response
    {
        $inscriptions = $doctrine->getRepository(Inscription::class)->find($id);
        
        if (!$inscriptions) {
            throw $this->createNotFoundException(
                'Aucune inscription trouvé avec le numéro ' . $id
            );
        }
        
        return $this->render('inscription/consulter.html.twig', [
            'inscription' => $inscriptions,
        ]);
    }

    public function ajouter(ManagerRegistry $doctrine,Request $request){
        $inscriptions = new Inscription();
	$form = $this->createForm(InscriptionType::class, $inscriptions);
	$form->handleRequest($request);
 
	if ($form->isSubmitted() && $form->isValid()) {
 
            $inscriptions = $form->getData();
 
            $entityManager = $doctrine->getManager();
            $entityManager->persist($inscriptions);
            $entityManager->flush();
            
   
 
	    return $this->render('inscription/consulter.html.twig', ['inscription' => $inscriptions,]);
	}
	else
        {
           
           return $this->render('inscription/ajouter.html.twig', array('form' => $form->createView(),));
	}
}

public function modifier(ManagerRegistry $doctrine, $id, Request $request){
 
    $inscriptions = $doctrine->getRepository(Inscription::class)->find($id);
 
	if (!$inscriptions) {
	    throw $this->createNotFoundException('Aucune inscription trouvé avec le numéro '.$id);
	}

	else
	{
            $form = $this->createForm(InscriptionModifierType::class, $inscriptions);
            $form->handleRequest($request);
 
            if ($form->isSubmitted() && $form->isValid()) {
 
                 $inscriptions = $form->getData();
                 $entityManager = $doctrine->getManager();
                 $entityManager->persist($inscriptions);
                 $entityManager->flush();
                 return $this->render('inscription/consulter.html.twig', ['inscription' => $inscriptions,]);
           }
           else{
                return $this->render('inscription/modifier.html.twig', array('form' => $form->createView(),));
           }
        }
 }
 public function supprimer(ManagerRegistry $doctrine, int $id): Response
 {
     $inscriptions = $doctrine->getRepository(Inscription::class)->find($id);

     if (!$inscriptions) {
         throw $this->createNotFoundException('Aucune inscriptions trouvé avec l\'ID '.$id);
     }

     $entityManager = $doctrine->getManager();
     $entityManager->remove($inscriptions); 
     $entityManager->flush();

     return $this->redirectToRoute('app_inscription_lister');
 }
}
