<?php

namespace App\Controller;

use App\Entity\Asignaturas;
use App\Form\AsignaturasFormType;
use App\Repository\AsignaturasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class AsignaturasController extends AbstractController
{
    #[Route('/asignaturas', name: 'asignaturas')]
    public function index(AsignaturasRepository $asignaturasRepository): Response
    {
        $asignaturas = $asignaturasRepository->findAll();

        return $this->render('asignaturas/index.html.twig', [
            'controller_name' => 'AsignaturasController',
            'asignaturas' => $asignaturas,
        ]);
    }

    #[Route('/asignaturas/create', name: 'newAsignatura')]
    public function create(Request $request, ManagerRegistry $doctrine)
    {
        $asignatura = new Asignaturas();

        $form = $this->createForm(AsignaturasFormType::class,$asignatura);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($asignatura);
            $em->flush();
            $this->addFlash('notices','Correctamente insertada');
        }
        return $this->render('asignaturas/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
