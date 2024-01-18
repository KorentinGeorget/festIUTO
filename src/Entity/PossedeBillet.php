<?php

namespace App\Entity;

use App\Repository\PossedeBilletRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PossedeBilletRepository::class)]
class PossedeBillet
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'billets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Spectateur $spectateur = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'spectateurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeBillet $billet = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateObtention = null;


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
}
