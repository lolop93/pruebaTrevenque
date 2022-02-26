<?php

namespace App\Form;



use App\Entity\Asignaturas;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatriculaFormType extends AbstractType
{
    private $em;

    public function __construct(ManagerRegistry $doctrine){
        $this->em = $doctrine->getManager();
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $choices = array();
        $asignaturas = $this->em->getRepository(Asignaturas::class)->findAll();

        foreach ($asignaturas as $asignatura){
            $choices[] = [$asignatura->getNombre() => $asignatura];
        }

        $builder
            ->add('asignaturas',ChoiceType::class,[
                'choices' => $choices,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        ]);
    }
}
