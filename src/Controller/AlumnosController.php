<?php

namespace App\Controller;

use App\Entity\Alumnos;
use App\Entity\Asignaturas;
use App\Form\AlumnosFormType;
use App\Form\MatriculaFormType;
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

            return $this->redirectToRoute('alumnos');
        }
        return $this->render('alumnos/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/alumnos/update/{id}', name: 'updateAlumno')]
    public function update(Request $request, ManagerRegistry $doctrine,$id)
    {
        $alumno = $doctrine->getManager()->getRepository(Alumnos::class)->find($id);

        $form = $this->createForm(AlumnosFormType::class,$alumno);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($alumno);
            $em->flush();
            $this->addFlash('notices','Correctamente actualizado');

            return $this->redirectToRoute('alumnos');
        }
        return $this->render('alumnos/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/alumnos/delete/{id}', name: 'deleteAlumno')]
    public function delete($id,ManagerRegistry $doctrine)
    {
        $alumno = $doctrine->getManager()->getRepository(Alumnos::class)->find($id);
        $em = $doctrine->getManager();
        $em->remove($alumno);
        $em->flush();

        $this->addFlash('notice','Correctamente eliminado');

        return $this->redirectToRoute('alumnos');
    }

    #[Route('/alumnos/matricular/{id}', name: 'addMatricula')]
    public function matricular(Request $request,$id,ManagerRegistry $doctrine)
    {
        $alumno = $doctrine->getManager()->getRepository(Alumnos::class)->find($id);
        $asignaturas = $doctrine->getManager()->getRepository(Asignaturas::class)->findAll();

        $form = $this->createForm(MatriculaFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $matricula = $doctrine->getManager()->getRepository(Asignaturas::class)->find($data['asignaturas']);

            $em = $doctrine->getManager();
            $alumno->addMatricula($matricula);
            $em->persist($alumno);
            $em->flush();
            $this->addFlash('notices','Correctamente matriculado');

            return $this->redirectToRoute('alumnos');
        }
        return $this->render('alumnos/matricular.html.twig', [
            'form' => $form->createView(),
            'asignaturas' => $asignaturas,
        ]);
    }
}
