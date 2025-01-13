<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
}
