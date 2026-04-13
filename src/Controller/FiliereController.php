<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FiliereController extends AbstractController
{
    #[Route('/filieres', name: 'filiere_index')]
    public function index(): Response
    {
        $filieres = [
            ['id' => 1, 'nom' => 'Génie Logiciel', 'description' => 'Formation en développement logiciel', 'image' => 'genie_logiciel.jpg'],
            ['id' => 2, 'nom' => 'Web et Internet Mobile', 'description' => 'Formation en développement web et mobile', 'image' => 'web_mobile.jpg'],
            ['id' => 3, 'nom' => 'Réseaux et Télécommunications', 'description' => 'Formation en réseaux informatiques', 'image' => 'reseaux.jpg'],
        ];

        return $this->render('front/filiere/index.html.twig', [
            'filieres' => $filieres,
        ]);
    }

    #[Route('/filieres/{id}', name: 'filiere_show')]
    public function show(int $id): Response
    {
        $filieres = [
            1 => ['id' => 1, 'nom' => 'Génie Logiciel', 'description' => 'Formation en développement logiciel', 'image' => 'genie_logiciel.jpg'],
            2 => ['id' => 2, 'nom' => 'Web et Internet Mobile', 'description' => 'Formation en développement web et mobile', 'image' => 'web_mobile.jpg'],
            3 => ['id' => 3, 'nom' => 'Réseaux et Télécommunications', 'description' => 'Formation en réseaux informatiques', 'image' => 'reseaux.jpg'],
        ];

        $filiere = $filieres[$id];

        return $this->render('front/filiere/show.html.twig', [
            'filiere' => $filiere,
        ]);
    }
}