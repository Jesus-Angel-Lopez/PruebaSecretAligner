<?php

namespace App\Entity;

use App\Repository\TODORepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TODORepository::class)
 */
class TODO
{
    public function __construct()
    {
        $this->setCreatedAt(new \DateTime('now'));
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_creacion;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_tope;

    /**
     * @ORM\Column(type="boolean")
     */
    private $realizada;

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

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fecha_creacion;
    }

    public function setFechaCreacion(\DateTimeInterface $fecha_creacion): self
    {
        $this->fecha_creacion = $fecha_creacion;

        return $this;
    }

    public function getFechaTope(): ?\DateTimeInterface
    {
        return $this->fecha_tope;
    }

    public function setFechaTope(\DateTimeInterface $fecha_tope): self
    {
        $this->fecha_tope = $fecha_tope;

        return $this;
    }

    public function estaRealizada(): ?bool
    {
        return $this->realizada;
    }

    public function setRealizada(bool $realizada): self
    {
        $this->realizada = $realizada;

        return $this;
    }
}
