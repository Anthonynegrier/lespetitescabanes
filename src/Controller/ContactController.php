<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Contact;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    public function lister(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Contact::class);
        $contacts= $repository->findAll();
    
        return $this->render('contact/lister.html.twig', [
            'contacts' => $contacts,
        ]);	
        
    }

    public function consulter(ManagerRegistry $doctrine, int $id): Response
    {
        $contacts = $doctrine->getRepository(Contact::class)->find($id);
        
        if (!$contacts) {
            throw $this->createNotFoundException(
                'Aucun contact trouvé avec le numéro ' . $id
            );
        }
        
        return $this->render('contact/consulter.html.twig', [
            'contact' => $contacts,
        ]);
    }
}