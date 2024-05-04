<?php

namespace App\Entity;

use App\Repository\AppareilRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppareilRepository::class)]
class Appareil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $code = null;

    #[ORM\Column(length: 255)]
    private ?string $designation = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?float $prixUnit = null;

    #[ORM\Column]
    private ?int $qteVendue = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateSortie = null;

    #[ORM\ManyToOne]
    private ?Systeme $idos = null;

    #[ORM\ManyToOne]
    private ?Fabricant $idfab = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): static
    {
        $this->designation = $designation;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPrixUnit(): ?float
    {
        return $this->prixUnit;
    }

    public function setPrixUnit(float $prixUnit): static
    {
        $this->prixUnit = $prixUnit;

        return $this;
    }

    public function getQteVendue(): ?int
    {
        return $this->qteVendue;
    }

    public function setQteVendue(int $qteVendue): static
    {
        $this->qteVendue = $qteVendue;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(\DateTimeInterface $dateSortie): static
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getIdos(): ?Systeme
    {
        return $this->idos;
    }

    public function setIdos(?Systeme $idos): static
    {
        $this->idos = $idos;

        return $this;
    }

    public function getIdfab(): ?Fabricant
    {
        return $this->idfab;
    }

    public function setIdfab(?Fabricant $idfab): static
    {
        $this->idfab = $idfab;

        return $this;
    }
}
