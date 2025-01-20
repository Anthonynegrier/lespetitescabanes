<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Personnel;

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
}