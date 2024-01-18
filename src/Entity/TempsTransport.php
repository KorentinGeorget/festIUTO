<?php

namespace App\Entity;

use App\Repository\TempsTransportRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TempsTransportRepository::class)]
class TempsTransport
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'tempsTransports')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LieuEvent $lieu1 = null;

    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?LieuEvent $lieu2 = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $temps = null;

    public function getLieu1(): ?LieuEvent
    {
        return $this->lieu1;
    }

    public function setLieu1(?LieuEvent $lieu1): static
    {
        $this->lieu1 = $lieu1;

        return $this;
    }

    public function getLieu2(): ?LieuEvent
    {
        return $this->lieu2;
    }

    public function setLieu2(?LieuEvent $lieu2): static
    {
        $this->lieu2 = $lieu2;

        return $this;
    }

    public function getTemps(): ?\DateTimeInterface
    {
        return $this->temps;
    }

    public function setTemps(\DateTimeInterface $temps): static
    {
        $this->temps = $temps;

        return $this;
    }
}
