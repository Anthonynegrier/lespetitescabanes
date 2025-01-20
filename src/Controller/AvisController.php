<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Avis;
use App\Form\AvisType;

class AvisController extends AbstractController
{
    #[Route('/avis', name: 'app_avis')]
    public function index(): Response
    {
        return $this->render('avis/index.html.twig', [
            'controller_name' => 'AvisController',
        ]);
    }

    public function lister(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Avis::class);
        $aviss= $repository->findAll();
    
        return $this->render('avis/lister.html.twig', [
            'aviss' => $aviss,
        ]);	
        
    }

    public function consulter(ManagerRegistry $doctrine, int $id): Response
    {
        $aviss = $doctrine->getRepository(Avis::class)->find($id);
        
        if (!$aviss) {
            throw $this->createNotFoundException(
                'Aucun avis trouvé avec le numéro ' . $id
            );
        }
        
        return $this->render('avis/consulter.html.twig', [
            'avis' => $aviss,
        ]);
    }

    public function ajouter(ManagerRegistry $doctrine,Request $request){
        $aviss = new Avis();
	    $form = $this->createForm(AvisType::class, $aviss);
	    $form->handleRequest($request);
 
	if ($form->isSubmitted() && $form->isValid()) {
 
            $aviss = $form->getData();
 
            $entityManager = $doctrine->getManager();
            $entityManager->persist($aviss);
            $entityManager->flush();
            
   
 
	    return $this->render('avis/consulter.html.twig', ['avis' => $aviss,]);
	}
	else
        {
           
           return $this->render('avis/ajouter.html.twig', array('form' => $form->createView(),));
	}
}
}
