<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EtablissementController extends AbstractController
{
    #[Route('/etablissements', name: 'etablissement_index')]
    public function index(): Response
    {
        $etablissements = [
            ['id' => 1, 'nom' => 'iP Net Institute of Technology', 'ville' => 'Lomé', 'description' => 'École supérieure en informatique', 'image' => 'ipnet.jpg'],
            ['id' => 2, 'nom' => 'Université de Lomé', 'ville' => 'Lomé', 'description' => 'Université publique du Togo', 'image' => 'ul.jpg'],
            ['id' => 3, 'nom' => 'ESTIM', 'ville' => 'Lomé', 'description' => 'École supérieure de technologie', 'image' => 'estim.jpg'],
        ];

        return $this->render('front/etablissement/index.html.twig', [
            'etablissements' => $etablissements,
        ]);
    }
}