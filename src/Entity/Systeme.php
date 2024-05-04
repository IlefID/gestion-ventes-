<?php

namespace App\Entity;

use App\Repository\SystemeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SystemeRepository::class)]
class Systeme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idos = null;

    #[ORM\Column(length: 100)]
    private ?string $famille = null;

    #[ORM\Column(length: 100)]
    private ?string $editeur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdos(): ?int
    {
        return $this->idos;
    }

    public function setIdos(int $idos): static
    {
        $this->idos = $idos;

        return $this;
    }

    public function getFamille(): ?string
    {
        return $this->famille;
    }

    public function setFamille(string $famille): static
    {
        $this->famille = $famille;

        return $this;
    }

    public function getEditeur(): ?string
    {
        return $this->editeur;
    }

    public function setEditeur(string $editeur): static
    {
        $this->editeur = $editeur;

        return $this;
    }
}
