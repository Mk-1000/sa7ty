<?php

namespace App\Controller;

use App\Entity\Hour;
use App\Form\HourType;
use App\Repository\HourRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/hour')]
class HourController extends AbstractController
{
    #[Route('/', name: 'app_hour_index', methods: ['GET'])]
    public function index(HourRepository $hourRepository): Response
    {
        return $this->render('hour/index.html.twig', [
            'hours' => $hourRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_hour_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $hour = new Hour();
        $form = $this->createForm(HourType::class, $hour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($hour);
            $entityManager->flush();

            return $this->redirectToRoute('app_hour_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hour/new.html.twig', [
            'hour' => $hour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hour_show', methods: ['GET'])]
    public function show(Hour $hour): Response
    {
        return $this->render('hour/show.html.twig', [
            'hour' => $hour,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hour_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hour $hour, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HourType::class, $hour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_hour_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hour/edit.html.twig', [
            'hour' => $hour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hour_delete', methods: ['POST'])]
    public function delete(Request $request, Hour $hour, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hour->getId(), $request->request->get('_token'))) {
            $entityManager->remove($hour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_hour_index', [], Response::HTTP_SEE_OTHER);
    }
}
