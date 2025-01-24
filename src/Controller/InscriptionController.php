<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Inscription;


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

}
