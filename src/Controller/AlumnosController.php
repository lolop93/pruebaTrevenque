<?php

namespace App\Controller;

use App\Entity\Alumnos;
use App\Form\AlumnosFormType;
use App\Repository\AlumnosRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/alumnos/create', name: 'newAlumno')]
    public function create(Request $request, ManagerRegistry $doctrine)
    {
        $alumno = new Alumnos();

        $form = $this->createForm(AlumnosFormType::class,$alumno);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($alumno);
            $em->flush();
            $this->addFlash('notices','Correctamente insertado');
        }
        return $this->render('alumnos/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/alumnos/update/{id}', name: 'updateAlumno')]
    public function update(Request $request, ManagerRegistry $doctrine,$id)
    {
        $alumno = new Alumnos();

        $form = $this->createForm(AlumnosFormType::class,$alumno);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($alumno);
            $em->flush();
            $this->addFlash('notices','Correctamente insertado');
        }
        return $this->render('alumnos/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/alumnos/delete', name: 'deleteAlumno')]
    public function delete()
    {

    }
}
