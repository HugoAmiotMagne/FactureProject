<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 12)]
    private ?string $ncom = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Client $ncli = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DATEcom = null;

    /**
     * @var Collection<int, Detail>
     */
    #[ORM\OneToMany(targetEntity: Detail::class, mappedBy: 'ncom')]
    private Collection $details;

    public function __construct()
    {
        $this->details = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNcom(): ?string
    {
        return $this->ncom;
    }

    public function setNcom(string $ncom): static
    {
        $this->ncom = $ncom;

        return $this;
    }

    public function getNcli(): ?Client
    {
        return $this->ncli;
    }

    public function setNcli(?Client $ncli): static
    {
        $this->ncli = $ncli;

        return $this;
    }

    public function getDATEcom(): ?\DateTimeInterface
    {
        return $this->DATEcom;
    }

    public function setDATEcom(\DateTimeInterface $DATEcom): static
    {
        $this->DATEcom = $DATEcom;

        return $this;
    }

    /**
     * @return Collection<int, Detail>
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function addDetail(Detail $detail): static
    {
        if (!$this->details->contains($detail)) {
            $this->details->add($detail);
            $detail->setNcom($this);
        }

        return $this;
    }

    public function removeDetail(Detail $detail): static
    {
        if ($this->details->removeElement($detail)) {
            // set the owning side to null (unless already changed)
            if ($detail->getNcom() === $this) {
                $detail->setNcom(null);
            }
        }

        return $this;
    }
}