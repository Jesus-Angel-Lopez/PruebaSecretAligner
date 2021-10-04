<?php

namespace App\Entity;

use App\Repository\ListaTODORepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListaTODORepository::class)
 */
class ListaTODO
{
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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="listaTODOs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $propietario;

    /**
     * @ORM\OneToMany(targetEntity=TODO::class, mappedBy="lista")
     */
    private $tODOs;

    public function __construct()
    {
        $this->tODOs = new ArrayCollection();
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

    public function getPropietario(): ?User
    {
        return $this->propietario;
    }

    public function setPropietario(?User $propietario): self
    {
        $this->propietario = $propietario;

        return $this;
    }

    /**
     * @return Collection|TODO[]
     */
    public function getTODOs(): Collection
    {
        return $this->tODOs;
    }

    public function addTODO(TODO $tODO): self
    {
        if (!$this->tODOs->contains($tODO)) {
            $this->tODOs[] = $tODO;
            $tODO->setLista($this);
        }

        return $this;
    }

    public function removeTODO(TODO $tODO): self
    {
        if ($this->tODOs->removeElement($tODO)) {
            // set the owning side to null (unless already changed)
            if ($tODO->getLista() === $this) {
                $tODO->setLista(null);
            }
        }

        return $this;
    }
}
