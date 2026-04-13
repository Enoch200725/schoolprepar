<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminEtablissementController extends AbstractController
{
    #[Route('/admin/etablissements', name: 'admin_etablissement_index')]
    public function index(): Response
    {
        $etablissements = [
            ['id' => 1, 'nom' => 'iP Net Institute of Technology', 'ville' => 'Lomé', 'description' => 'École supérieure en informatique'],
            ['id' => 2, 'nom' => 'Université de Lomé', 'ville' => 'Lomé', 'description' => 'Université publique du Togo'],
            ['id' => 3, 'nom' => 'ESTIM', 'ville' => 'Lomé', 'description' => 'École supérieure de technologie'],
        ];

        return $this->render('admin/etablissement/index.html.twig', [
            'etablissements' => $etablissements,
        ]);
    }
}