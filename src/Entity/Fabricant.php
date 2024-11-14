<?php

namespace App\Entity;

use App\Repository\FabricantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FabricantRepository::class)]
class Fabricant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idfab = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $paysOrigine = null;

    #[ORM\Column(type: 'string', length: 600, nullable: true)]
    private ?string $imageUrl = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdfab(): ?int
    {
        return $this->idfab;
    }

    public function setIdfab(int $idfab): static
    {
        $this->idfab = $idfab;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPaysOrigine(): ?string
    {
        return $this->paysOrigine;
    }

    public function setPaysOrigine(string $paysOrigine): static
    {
        $this->paysOrigine = $paysOrigine;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }
}
