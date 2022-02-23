<?php

namespace App\Entity;

use App\Repository\AlumnosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlumnosRepository::class)]
class Alumnos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $apellidos;

    #[ORM\Column(type: 'date')]
    private $anionacimiento;

    #[ORM\OneToMany(mappedBy: 'alumno', targetEntity: Calificaciones::class, orphanRemoval: true)]
    private $calificaciones;

    #[ORM\ManyToMany(targetEntity: Asignaturas::class, inversedBy: 'alumnos')]
    private $matricula;



    public function __construct()
    {
        $this->calificaciones = new ArrayCollection();
        $this->matricula = new ArrayCollection();

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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getAnionacimiento(): ?\DateTimeInterface
    {
        return $this->anionacimiento;
    }

    public function setAnionacimiento(\DateTimeInterface $anionacimiento): self
    {
        $this->anionacimiento = $anionacimiento;

        return $this;
    }

    /**
     * @return Collection<int, Calificaciones>
     */
    public function getCalificaciones(): Collection
    {
        return $this->calificaciones;
    }

    public function addCalificacione(Calificaciones $calificacione): self
    {
        if (!$this->calificaciones->contains($calificacione)) {
            $this->calificaciones[] = $calificacione;
            $calificacione->setAlumno($this);
        }

        return $this;
    }

    public function removeCalificacione(Calificaciones $calificacione): self
    {
        if ($this->calificaciones->removeElement($calificacione)) {
            // set the owning side to null (unless already changed)
            if ($calificacione->getAlumno() === $this) {
                $calificacione->setAlumno(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Asignaturas>
     */
    public function getMatricula(): Collection
    {
        return $this->matricula;
    }

    public function addMatricula(Asignaturas $matricula): self
    {
        if (!$this->matricula->contains($matricula)) {
            $this->matricula[] = $matricula;
        }

        return $this;
    }

    public function removeMatricula(Asignaturas $matricula): self
    {
        $this->matricula->removeElement($matricula);

        return $this;
    }


}
