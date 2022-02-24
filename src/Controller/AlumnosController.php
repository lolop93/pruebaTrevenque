<?php

namespace App\Controller;

use App\Repository\AlumnosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlumnosController extends AbstractController
{
    #[Route('/alumnos', name: 'alumnos')]
    public function index(AlumnosRepository $alumnosRepository): Response
    {
        $alumnos = $alumnosRepository->findAll();

        return $this->render('alumnos/index.html.twig', [
            'controller_name' => 'AlumnosController',
            'alumnos' => $alumnos,
        ]);
    }
}
