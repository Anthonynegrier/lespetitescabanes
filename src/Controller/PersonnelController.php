<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Personnel;
use App\Entity\Creche;
use App\Form\PersonnelType;
use App\Form\PersonnelModifierType;


class PersonnelController extends AbstractController
{
    #[Route('/personnel', name: 'app_personnel')]
    public function index(): Response
    {
        return $this->render('personnel/index.html.twig', [
            'controller_name' => 'PersonnelController',
        ]);
    }

    public function lister(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Personnel::class);
        $personnels= $repository->findAll();
    
        return $this->render('personnel/lister.html.twig', [
            'personnels' => $personnels,
        ]);	
        
    }

    public function consulter(ManagerRegistry $doctrine, int $id): Response
    {
        $personnels = $doctrine->getRepository(Personnel::class)->find($id);
        
        if (!$personnels) {
            throw $this->createNotFoundException(
                'Aucun personnel trouvé avec le numéro ' . $id
            );
        }
        
        return $this->render('personnel/consulter.html.twig', [
            'personnel' => $personnels,
            
        ]);
    }

    public function ajouter(ManagerRegistry $doctrine,Request $request){
        $personnels = new Personnel();
	$form = $this->createForm(PersonnelType::class, $personnels);
	$form->handleRequest($request);
 
	if ($form->isSubmitted() && $form->isValid()) {
 
            $personnels = $form->getData();
 
            $entityManager = $doctrine->getManager();
            $entityManager->persist($personnels);
            $entityManager->flush();
            
   
 
	    return $this->render('personnel/consulter.html.twig', ['personnel' => $personnels,]);
	}
	else
        {
           
           return $this->render('personnel/ajouter.html.twig', array('form' => $form->createView(),));
	}
}

public function modifier(ManagerRegistry $doctrine, $id, Request $request){
 
    $personnels = $doctrine->getRepository(Personnel::class)->find($id);
 
	if (!$personnels) {
	    throw $this->createNotFoundException('Aucun personnels trouvé avec le numéro '.$id);
	}

	else
	{
            $form = $this->createForm(PersonnelModifierType::class, $personnels);
            $form->handleRequest($request);
 
            if ($form->isSubmitted() && $form->isValid()) {
 
                 $personnels = $form->getData();
                 $entityManager = $doctrine->getManager();
                 $entityManager->persist($personnels);
                 $entityManager->flush();
                 return $this->render('personnel/consulter.html.twig', ['personnel' => $personnels,]);
           }
           else{
                return $this->render('personnel/modifier.html.twig', array('form' => $form->createView(),));
           }
        }
 }

 public function supprimer(ManagerRegistry $doctrine, int $id): Response
 {
     $personnels = $doctrine->getRepository(Personnel::class)->find($id);

     if (!$personnels) {
         throw $this->createNotFoundException('Aucune personnels trouvé avec l\'ID '.$id);
     }

     $entityManager = $doctrine->getManager();
     $entityManager->remove($personnels); 
     $entityManager->flush();

     return $this->redirectToRoute('app_personnel_lister');
 }
}