<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    private ?string $npro = null;

    #[ORM\Column(length: 60)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 0)]
    private ?string $prix = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 0)]
    private ?string $qstock = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNpro(): ?string
    {
        return $this->npro;
    }

    public function setNpro(string $npro): static
    {
        $this->npro = $npro;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQstock(): ?string
    {
        return $this->qstock;
    }

    public function setQstock(string $qstock): static
    {
        $this->qstock = $qstock;

        return $this;
    }
}
