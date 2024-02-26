<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\DoctorRepository;
use App\Repository\PatientRepository;
use App\Repository\SecretaryRepository;


class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/adminDoctor', name: 'admin_doctor_index', methods: ['GET'])]
    public function adminDoctor(DoctorRepository $doctorRepository): Response
    {
        return $this->render('admin/doctor_index.html.twig', [
            'doctors' => $doctorRepository->findAll(),
        ]);
    }

    #[Route('/adminPatient', name: 'admin_patient_index', methods: ['GET'])]
    public function adminPatient(PatientRepository $patientRepository): Response
    {
        return $this->render('admin/patient_index.html.twig', [
            'patients' => $patientRepository->findAll(),
        ]);
    }

    #[Route('/adminSecretary', name: 'admin_secretary_index', methods: ['GET'])]
    public function adminSecretary(SecretaryRepository $secretaryRepository): Response
    {
        return $this->render('admin/secretary_index.html.twig', [
            'secretaries' => $secretaryRepository->findAll(),
        ]);
    }
}
