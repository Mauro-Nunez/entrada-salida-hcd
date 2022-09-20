<?php

namespace App\Entity;

use App\Repository\ConcejalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConcejalRepository::class)
 */
class Concejal
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
     * @ORM\OneToMany(targetEntity=Novedad::class, mappedBy="concejal")
     */
    private $novedads;

    public function __construct()
    {
        $this->novedads = new ArrayCollection();
    }

    public function __toString(): ?string
    {
        return $this->nombre;
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

    /**
     * @return Collection<int, Novedad>
     */
    public function getNovedads(): Collection
    {
        return $this->novedads;
    }

    public function addNovedad(Novedad $novedad): self
    {
        if (!$this->novedads->contains($novedad)) {
            $this->novedads[] = $novedad;
            $novedad->setConcejal($this);
        }

        return $this;
    }

    public function removeNovedad(Novedad $novedad): self
    {
        if ($this->novedads->removeElement($novedad)) {
            // set the owning side to null (unless already changed)
            if ($novedad->getConcejal() === $this) {
                $novedad->setConcejal(null);
            }
        }

        return $this;
    }
}
