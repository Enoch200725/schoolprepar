<?php

namespace App\Controller;

use App\Entity\Conseiller;
use App\Form\ConseillerType;
use App\Repository\ConseillerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/conseiller')]
final class ConseillerController extends AbstractController
{
    #[Route(name: 'app_conseiller_index', methods: ['GET'])]
    public function index(ConseillerRepository $conseillerRepository): Response
    {
        return $this->render('conseiller/index.html.twig', [
            'conseillers' => $conseillerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_conseiller_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $conseiller = new Conseiller();
        $form = $this->createForm(ConseillerType::class, $conseiller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($conseiller);
            $entityManager->flush();

            return $this->redirectToRoute('app_conseiller_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('conseiller/new.html.twig', [
            'conseiller' => $conseiller,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conseiller_show', methods: ['GET'])]
    public function show(Conseiller $conseiller): Response
    {
        return $this->render('conseiller/show.html.twig', [
            'conseiller' => $conseiller,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_conseiller_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Conseiller $conseiller, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConseillerType::class, $conseiller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_conseiller_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('conseiller/edit.html.twig', [
            'conseiller' => $conseiller,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conseiller_delete', methods: ['POST'])]
    public function delete(Request $request, Conseiller $conseiller, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conseiller->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($conseiller);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_conseiller_index', [], Response::HTTP_SEE_OTHER);
    }
}
