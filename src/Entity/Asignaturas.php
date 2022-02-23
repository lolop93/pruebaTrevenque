<?php

namespace App\Entity;

use App\Repository\AsignaturasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AsignaturasRepository::class)]
class Asignaturas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $Titulacion;

    #[ORM\Column(type: 'float')]
    private $creditos;

    #[ORM\Column(type: 'date')]
    private $curso;

    #[ORM\Column(type: 'integer')]
    private $maxalumnos;

    #[ORM\ManyToMany(targetEntity: Alumnos::class, mappedBy: 'matricula')]
    private $alumnos;


    public function __construct()
    {
        $this->alumnos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getTitulacion(): ?string
    {
        return $this->Titulacion;
    }

    public function setTitulacion(string $Titulacion): self
    {
        $this->Titulacion = $Titulacion;

        return $this;
    }

    public function getCreditos(): ?float
    {
        return $this->creditos;
    }

    public function setCreditos(float $creditos): self
    {
        $this->creditos = $creditos;

        return $this;
    }

    public function getCurso(): ?\DateTimeInterface
    {
        return $this->curso;
    }

    public function setCurso(\DateTimeInterface $curso): self
    {
        $this->curso = $curso;

        return $this;
    }

    public function getMaxalumnos(): ?int
    {
        return $this->maxalumnos;
    }

    public function setMaxalumnos(int $maxalumnos): self
    {
        $this->maxalumnos = $maxalumnos;

        return $this;
    }

    /**
     * @return Collection<int, Alumnos>
     */
    public function getAlumnos(): Collection
    {
        return $this->alumnos;
    }

    public function addAlumno(Alumnos $alumno): self
    {
        if (!$this->alumnos->contains($alumno)) {
            $this->alumnos[] = $alumno;
            $alumno->addMatricula($this);
        }

        return $this;
    }

    public function removeAlumno(Alumnos $alumno): self
    {
        if ($this->alumnos->removeElement($alumno)) {
            $alumno->removeMatricula($this);
        }

        return $this;
    }


}
