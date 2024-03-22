<?php

namespace App\Controller;

use App\Entity\Avilibility;
use App\Form\AvilibilityType;
use App\Repository\AvilibilityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/avilibility')]
class AvilibilityController extends AbstractController
{
    #[Route('/', name: 'app_avilibility_index', methods: ['GET'])]
    public function index(AvilibilityRepository $avilibilityRepository): Response
    {
        return $this->render('avilibility/index.html.twig', [
            'avilibilities' => $avilibilityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_avilibility_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avilibility = new Avilibility();
        $form = $this->createForm(AvilibilityType::class, $avilibility);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avilibility);
            $entityManager->flush();

            return $this->redirectToRoute('app_avilibility_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('avilibility/new.html.twig', [
            'avilibility' => $avilibility,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_avilibility_show', methods: ['GET'])]
    public function show(Avilibility $avilibility): Response
    {
        return $this->render('avilibility/show.html.twig', [
            'avilibility' => $avilibility,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_avilibility_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Avilibility $avilibility, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvilibilityType::class, $avilibility);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_avilibility_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('avilibility/edit.html.twig', [
            'avilibility' => $avilibility,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_avilibility_delete', methods: ['POST'])]
    public function delete(Request $request, Avilibility $avilibility, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avilibility->getId(), $request->request->get('_token'))) {
            $entityManager->remove($avilibility);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_avilibility_index', [], Response::HTTP_SEE_OTHER);
    }
}
