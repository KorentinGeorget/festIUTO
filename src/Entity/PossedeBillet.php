<?php

namespace App\Entity;

use App\Repository\PossedeBilletRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PossedeBilletRepository::class)]
class PossedeBillet
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\ManyToOne(inversedBy: 'billets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Spectateur $spectateur = null;

    #[ORM\ManyToOne(inversedBy: 'spectateurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeBillet $billet = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateObtention = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getSpectateur(): ?Spectateur
    {
        return $this->spectateur;
    }

    public function setSpectateur(?Spectateur $spectateur): static
    {
        $this->spectateur = $spectateur;

        return $this;
    }

    public function getBillet(): ?TypeBillet
    {
        return $this->billet;
    }

    public function setBillet(?TypeBillet $billet): static
    {
        $this->billet = $billet;

        return $this;
    }

    public function getDateObtention(): ?\DateTimeInterface
    {
        return $this->dateObtention;
    }

    public function setDateObtention(\DateTimeInterface $dateObtention): static
    {
        $this->dateObtention = $dateObtention;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getSpectateur()->getNom() . ' ' . $this->getSpectateur()->getPrenom() . ' ' . $this->getBillet()->getTypeBillet();
    }
}
