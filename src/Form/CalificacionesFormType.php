<?php

namespace App\Form;

use App\Entity\Calificaciones;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalificacionesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        foreach ($options['asignaturas'] as $asignatura){
            $choices[] = [$asignatura->getNombre() => $asignatura];
        }

        $builder
            ->add('primeraConvocatoria')
            ->add('segundaConvocatoria')
            ->add('asignatura',ChoiceType::class,[
                'choices' => $choices,
            ])
            //->add('alumno')
            //->add('asignatura')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calificaciones::class,
            'asignaturas' => Asignaturas::class,
        ]);
    }
}
