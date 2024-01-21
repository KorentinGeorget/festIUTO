<?php

namespace App\Entity;

use App\Repository\TypeBilletRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeBilletRepository::class)]
class TypeBillet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $typeBillet = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $dureeBillet = null;

    #[ORM\OneToMany(mappedBy: 'billet', targetEntity: PossedeBillet::class, orphanRemoval: true)]
    private Collection $spectateurs;

    public function __construct()
    {
        $this->spectateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeBillet(): ?string
    {
        return $this->typeBillet;
    }

    public function setTypeBillet(string $typeBillet): static
    {
        $this->typeBillet = $typeBillet;

        return $this;
    }

    public function getDureeBillet(): ?\DateTimeInterface
    {
        return $this->dureeBillet;
    }

    public function setDureeBillet(\DateTimeInterface $dureeBillet): static
    {
        $this->dureeBillet = $dureeBillet;

        return $this;
    }

    /**
     * @return Collection<int, PossedeBillet>
     */
    public function getSpectateurs(): Collection
    {
        return $this->spectateurs;
    }

    public function addSpectateur(PossedeBillet $spectateur): static
    {
        if (!$this->spectateurs->contains($spectateur)) {
            $this->spectateurs->add($spectateur);
            $spectateur->setBillet($this);
        }

        return $this;
    }

    public function removeSpectateur(PossedeBillet $spectateur): static
    {
        if ($this->spectateurs->removeElement($spectateur)) {
            // set the owning side to null (unless already changed)
            if ($spectateur->getBillet() === $this) {
                $spectateur->setBillet(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getTypeBillet();
    }
}
