<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Creche;
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
}