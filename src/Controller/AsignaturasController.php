<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AsignaturasController extends AbstractController
{
    #[Route('/asignaturas', name: 'asignaturas')]
    public function index(): Response
    {
        return $this->render('asignaturas/index.html.twig', [
            'controller_name' => 'AsignaturasController',
        ]);
    }
}
