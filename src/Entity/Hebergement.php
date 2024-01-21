<?php

namespace App\Entity;

use App\Repository\HebergementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HebergementRepository::class)]
class Hebergement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nomHebergement = null;

    #[ORM\Column(length: 200)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?int $nbPlaceHebergement = null;

    #[ORM\ManyToMany(targetEntity: Groupe::class, mappedBy: 'hebergements')]
    private Collection $groupes;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomHebergement(): ?string
    {
        return $this->nomHebergement;
    }

    public function setNomHebergement(string $nomHebergement): static
    {
        $this->nomHebergement = $nomHebergement;

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

    public function getNbPlaceHebergement(): ?int
    {
        return $this->nbPlaceHebergement;
    }

    public function setNbPlaceHebergement(int $nbPlaceHebergement): static
    {
        $this->nbPlaceHebergement = $nbPlaceHebergement;

        return $this;
    }

    /**
     * @return Collection<int, Groupe>
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): static
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes->add($groupe);
            $groupe->addHebergement($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): static
    {
        if ($this->groupes->removeElement($groupe)) {
            $groupe->removeHebergement($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nomHebergement;
    }
}
