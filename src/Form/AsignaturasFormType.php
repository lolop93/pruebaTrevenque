<?php

namespace App\Form;

use App\Entity\Asignaturas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AsignaturasFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('Titulacion')
            ->add('creditos')
            ->add('curso')
            ->add('maxalumnos')
            //->add('alumnos')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Asignaturas::class,
        ]);
    }
}
