<?php

namespace App\Entity;

use App\Repository\CalificacionesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalificacionesRepository::class)]
class Calificaciones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float', nullable: true)]
    private $primeraConvocatoria;

    #[ORM\Column(type: 'float', nullable: true)]
    private $segundaConvocatoria;

    #[ORM\ManyToOne(targetEntity: Alumnos::class, inversedBy: 'calificaciones')]
    #[ORM\JoinColumn(nullable: false)]
    private $alumno;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrimeraConvocatoria(): ?float
    {
        return $this->primeraConvocatoria;
    }

    public function setPrimeraConvocatoria(?float $primeraConvocatoria): self
    {
        $this->primeraConvocatoria = $primeraConvocatoria;

        return $this;
    }

    public function getSegundaConvocatoria(): ?float
    {
        return $this->segundaConvocatoria;
    }

    public function setSegundaConvocatoria(?float $segundaConvocatoria): self
    {
        $this->segundaConvocatoria = $segundaConvocatoria;

        return $this;
    }

    public function getAlumno(): ?Alumnos
    {
        return $this->alumno;
    }

    public function setAlumno(?Alumnos $alumno): self
    {
        $this->alumno = $alumno;

        return $this;
    }
}
