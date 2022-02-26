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
            $this->addFlash('notice','Correctamente insertada');

            return $this->redirectToRoute('asignaturas');
        }
        return $this->render('asignaturas/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/asignaturas/update/{id}', name: 'updateAsignatura')]
    public function update(Request $request, ManagerRegistry $doctrine,$id)
    {
        $asignatura = $doctrine->getManager()->getRepository(Asignaturas::class)->find($id);

        $form = $this->createForm(AsignaturasFormType::class,$asignatura);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($asignatura);
            $em->flush();
            $this->addFlash('notice','Correctamente actualizada');

            return $this->redirectToRoute('asignaturas');
        }
        return $this->render('asignaturas/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/asignatura/delete/{id}', name: 'deleteAsignatura')]
    public function delete($id,ManagerRegistry $doctrine)
    {
        $asignatura = $doctrine->getManager()->getRepository(Asignaturas::class)->find($id);
        $em = $doctrine->getManager();
        $em->remove($asignatura);
        $em->flush();

        $this->addFlash('notice','Correctamente eliminado');

        return $this->redirectToRoute('asignaturas');
    }

    #[Route('/asignaturas/{id}', name: 'asignatura')]
    public function asignatura(ManagerRegistry $doctrine,$id): Response
    {
        $asignatura = $doctrine->getManager()->getRepository(Asignaturas::class)->find($id);

        return $this->render('asignaturas/asignatura.html.twig', [
            'asignatura' => $asignatura,
        ]);
    }
}
