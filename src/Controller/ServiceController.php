<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/service/{nom}', name: 'app_service')]
    public function index($nom): Response
    {
        return $this->render('service/index.html.twig', [
            'n' => $nom,
        ]);
    }
    #[Route('/afficher/{nom}/{desc}', name: 'affiche_service')]
    public function afficher($nom, $desc): Response
    {
        $services = [
            [
                'name' => 'Finance',
                'description' => 'Description Finance'
            ],
            [
                'name' => 'Informatique',
                'description' => 'Description Info'
            ]
        ];
        return $this->render('service/afficher.html.twig', [
            'nomService' => $nom,
            'desc' => $desc,
            'services' => $services
        ]);
    }
}
