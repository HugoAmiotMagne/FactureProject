<?php

namespace App\Entity;

use App\Repository\DetailRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailRepository::class)]
class Detail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 0)]
    private ?string $qcom = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    private ?Commande $ncom = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    private ?Produit $npro = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQcom(): ?string
    {
        return $this->qcom;
    }

    public function setQcom(string $qcom): static
    {
        $this->qcom = $qcom;

        return $this;
    }

    public function getNcom(): ?Commande
    {
        return $this->ncom;
    }

    public function setNcom(?Commande $ncom): static
    {
        $this->ncom = $ncom;

        return $this;
    }

    public function getNpro(): ?Produit
    {
        return $this->npro;
    }

    public function setNpro(?Produit $npro): static
    {
        $this->npro = $npro;

        return $this;
    }

    }


