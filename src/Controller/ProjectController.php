<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    #[Route('/project/{nom}', name: 'app_project')]
    public function index($nom): Response
    {
        $classe = "3A9";
        return $this->render('project/index.html.twig', [
            'c' => $classe,
            'nom' => $nom
        ]);
    }

    #[Route('/afficher/{name}/{description}', name:"app_afficher")]
    public function afficher($name, $description):Response {
        $projects = [
            [
                'name' => 'MERN',
                'description' => 'description 1'
            ],
            [
                'name' => 'MEAN',
                'description' => 'description 2'
            ]
            ];
        return $this->render('project/afficher.html.twig', [
            'n' => $name,
            'desc' => $description,
            'projects' => $projects
        ]);
    }
}
