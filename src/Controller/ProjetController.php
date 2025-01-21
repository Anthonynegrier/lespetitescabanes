<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Projet;
use App\Form\ProjetType;



class ProjetController extends AbstractController
{
    #[Route('/projet', name: 'app_projet')]
    public function index(): Response
    {
        return $this->render('projet/index.html.twig', [
            'controller_name' => 'ProjetController',
        ]);
    }

    public function lister(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Projet::class);
        $projets= $repository->findAll();
    
        return $this->render('projet/lister.html.twig', [
            'projets' => $projets,
        ]);	
        
    }

    public function consulter(ManagerRegistry $doctrine, int $id): Response
    {
        $projets = $doctrine->getRepository(Projet::class)->find($id);
        
        if (!$projets) {
            throw $this->createNotFoundException(
                'Aucun projet trouvé avec le numéro ' . $id
            );
        }
        
        return $this->render('projet/consulter.html.twig', [
            'projet' => $projets,
        ]);
    }

    public function ajouter(ManagerRegistry $doctrine,Request $request){
        $projets = new Projet();
	$form = $this->createForm(ProjetType::class, $projets);
	$form->handleRequest($request);
 
	if ($form->isSubmitted() && $form->isValid()) {
 
            $projets = $form->getData();
 
            $entityManager = $doctrine->getManager();
            $entityManager->persist($projets);
            $entityManager->flush();
            
   
 
	    return $this->render('projet/consulter.html.twig', ['projet' => $projets,]);
	}
	else
        {
           
           return $this->render('projet/ajouter.html.twig', array('form' => $form->createView(),));
	}
}
}
