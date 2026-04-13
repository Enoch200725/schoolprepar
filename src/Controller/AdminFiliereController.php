<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminFiliereController extends AbstractController
{
    #[Route('/admin/filieres', name: 'admin_filiere_index')]
    public function index(): Response
    {
        $filieres = [
            ['id' => 1, 'nom' => 'Génie Logiciel', 'description' => 'Formation en développement logiciel'],
            ['id' => 2, 'nom' => 'Web et Internet Mobile', 'description' => 'Formation en développement web et mobile'],
            ['id' => 3, 'nom' => 'Réseaux et Télécommunications', 'description' => 'Formation en réseaux informatiques'],
        ];

        return $this->render('admin/filiere/index.html.twig', [
            'filieres' => $filieres,
        ]);
    }
}