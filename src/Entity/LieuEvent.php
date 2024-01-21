<?php

namespace App\Entity;

use App\Repository\LieuEventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LieuEventRepository::class)]
class LieuEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomLieu = null;

    #[ORM\Column(length: 200)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?int $nombrePlaceLieu = null;

    #[ORM\OneToMany(mappedBy: 'lieu1', targetEntity: TempsTransport::class, orphanRemoval: true)]
    private Collection $tempsTransports;

    #[ORM\OneToMany(mappedBy: 'lieuEvent', targetEntity: Evenement::class, orphanRemoval: true)]
    private Collection $evenements;

    public function __construct()
    {
        $this->tempsTransports = new ArrayCollection();
        $this->evenements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLieu(): ?string
    {
        return $this->nomLieu;
    }

    public function setNomLieu(string $nomLieu): static
    {
        $this->nomLieu = $nomLieu;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNombrePlaceLieu(): ?int
    {
        return $this->nombrePlaceLieu;
    }

    public function setNombrePlaceLieu(int $nombrePlaceLieu): static
    {
        $this->nombrePlaceLieu = $nombrePlaceLieu;

        return $this;
    }

    /**
     * @return Collection<int, TempsTransport>
     */
    public function getTempsTransports(): Collection
    {
        return $this->tempsTransports;
    }

    public function addTempsTransport(TempsTransport $tempsTransport): static
    {
        if (!$this->tempsTransports->contains($tempsTransport)) {
            $this->tempsTransports->add($tempsTransport);
            $tempsTransport->setLieu1($this);
        }

        return $this;
    }

    public function removeTempsTransport(TempsTransport $tempsTransport): static
    {
        if ($this->tempsTransports->removeElement($tempsTransport)) {
            // set the owning side to null (unless already changed)
            if ($tempsTransport->getLieu1() === $this) {
                $tempsTransport->setLieu1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Evenement>
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): static
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements->add($evenement);
            $evenement->setLieuEvent($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): static
    {
        if ($this->evenements->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getLieuEvent() === $this) {
                $evenement->setLieuEvent(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nomLieu;
    }
}
