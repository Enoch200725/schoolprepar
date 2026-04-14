<?php

namespace App\Controller;

use App\Repository\FiliereRepository;
use App\Repository\EtablissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('front/home.html.twig');
    }

    #[Route('/filieres', name: 'front_filiere_index')]
    public function filieres(FiliereRepository $filiereRepository): Response
    {
        $filieres = $filiereRepository->findAll();
        return $this->render('front/filiere/index.html.twig', [
            'filieres' => $filieres,
        ]);
    }

    #[Route('/filieres/{id}', name: 'front_filiere_show')]
    public function filiereShow(int $id, FiliereRepository $filiereRepository): Response
    {
        $filiere = $filiereRepository->find($id);
        return $this->render('front/filiere/show.html.twig', [
            'filiere' => $filiere,
        ]);
    }

    #[Route('/etablissements', name: 'front_etablissement_index')]
    public function etablissements(EtablissementRepository $etablissementRepository): Response
    {
        $etablissements = $etablissementRepository->findAll();
        return $this->render('front/etablissement/index.html.twig', [
            'etablissements' => $etablissements,
        ]);
    }
}