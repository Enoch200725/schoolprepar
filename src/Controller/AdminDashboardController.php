<?php

namespace App\Controller;

use App\Repository\FiliereRepository;
use App\Repository\EtablissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminDashboardController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
    public function index(
        FiliereRepository $filiereRepository,
        EtablissementRepository $etablissementRepository
    ): Response
    {
        $filieres = $filiereRepository->findAll();
        $etablissements = $etablissementRepository->findAll();

        $stats = [
            'filieres' => count($filieres),
            'etablissements' => count($etablissements),
        ];

        return $this->render('admin/dashboard.html.twig', [
            'stats' => $stats,
            'filieres' => $filieres,
        ]);
    }
}