<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateEv = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heureDebut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $tempsMontage = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $dureeEv = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $tempsDemontage = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeEvent $typeEvent = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LieuEvent $lieuEvent = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Groupe $groupe = null;

    #[ORM\Column]
    private ?bool $isPayant = null;

    #[ORM\ManyToMany(targetEntity: Spectateur::class, inversedBy: 'evenements')]
    private Collection $spectateurs;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    private ?Festival $festival = null;

    public function __construct()
    {
        $this->spectateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateEv(): ?\DateTimeInterface
    {
        return $this->dateEv;
    }

    public function setDateEv(\DateTimeInterface $dateEv): static
    {
        $this->dateEv = $dateEv;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $heureDebut): static
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getTempsMontage(): ?\DateTimeInterface
    {
        return $this->tempsMontage;
    }

    public function setTempsMontage(\DateTimeInterface $tempsMontage): static
    {
        $this->tempsMontage = $tempsMontage;

        return $this;
    }

    public function getDureeEv(): ?\DateTimeInterface
    {
        return $this->dureeEv;
    }

    public function setDureeEv(\DateTimeInterface $dureeEv): static
    {
        $this->dureeEv = $dureeEv;

        return $this;
    }

    public function getTempsDemontage(): ?\DateTimeInterface
    {
        return $this->tempsDemontage;
    }

    public function setTempsDemontage(\DateTimeInterface $tempsDemontage): static
    {
        $this->tempsDemontage = $tempsDemontage;

        return $this;
    }

    public function getTypeEvent(): ?TypeEvent
    {
        return $this->typeEvent;
    }

    public function setTypeEvent(?TypeEvent $typeEvent): static
    {
        $this->typeEvent = $typeEvent;

        return $this;
    }

    public function getLieuEvent(): ?LieuEvent
    {
        return $this->lieuEvent;
    }

    public function setLieuEvent(?LieuEvent $lieuEvent): static
    {
        $this->lieuEvent = $lieuEvent;

        return $this;
    }

    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): static
    {
        $this->groupe = $groupe;

        return $this;
    }

    public function isIsPayant(): ?bool
    {
        return $this->isPayant;
    }

    public function setIsPayant(bool $isPayant): static
    {
        $this->isPayant = $isPayant;

        return $this;
    }

    /**
     * @return Collection<int, Spectateur>
     */
    public function getSpectateurs(): Collection
    {
        return $this->spectateurs;
    }

    public function addSpectateur(Spectateur $spectateur): static
    {
        if (!$this->spectateurs->contains($spectateur)) {
            $this->spectateurs->add($spectateur);
        }

        return $this;
    }

    public function removeSpectateur(Spectateur $spectateur): static
    {
        $this->spectateurs->removeElement($spectateur);

        return $this;
    }

    public function getFestival(): ?Festival
    {
        return $this->festival;
    }

    public function setFestival(?Festival $festival): static
    {
        $this->festival = $festival;

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
    } 
}
