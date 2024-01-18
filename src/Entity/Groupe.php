<?php

namespace App\Entity;

use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeRepository::class)]
class Groupe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nomGroupe = null;

    #[ORM\OneToMany(mappedBy: 'groupe', targetEntity: Evenement::class, orphanRemoval: true)]
    private Collection $evenements;

    #[ORM\ManyToMany(targetEntity: Hebergement::class, inversedBy: 'groupes')]
    private Collection $hebergements;

    #[ORM\ManyToMany(targetEntity: Style::class, inversedBy: 'groupes')]
    private Collection $styles;

    #[ORM\OneToMany(mappedBy: 'groupe', targetEntity: Membre::class)]
    private Collection $membres;

    #[ORM\ManyToMany(targetEntity: Spectateur::class, mappedBy: 'groupeFavoris')]
    private Collection $spectateursFavoris;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
        $this->hebergements = new ArrayCollection();
        $this->styles = new ArrayCollection();
        $this->membres = new ArrayCollection();
        $this->spectateursFavoris = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomGroupe(): ?string
    {
        return $this->nomGroupe;
    }

    public function setNomGroupe(string $nomGroupe): static
    {
        $this->nomGroupe = $nomGroupe;

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
            $evenement->setGroupe($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): static
    {
        if ($this->evenements->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getGroupe() === $this) {
                $evenement->setGroupe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Hebergement>
     */
    public function getHebergement(): Collection
    {
        return $this->hebergements;
    }

    public function addHebergement(Hebergement $hebergement): static
    {
        if (!$this->hebergements->contains($hebergement)) {
            $this->hebergements->add($hebergement);
            $hebergement->addGroupe($this);
        }

        return $this;
    }

    public function removeHebergement(Hebergement $hebergement): static
    {
        $this->hebergements->removeElement($hebergement);
        $hebergement->removeGroupe($this);

        return $this;
    }

    /**
     * @return Collection<int, Style>
     */
    public function getStyles(): Collection
    {
        return $this->styles;
    }

    public function addStyle(Style $style): static
    {
        if (!$this->styles->contains($style)) {
            $this->styles->add($style);
            $style->addGroupe($this);
        }

        return $this;
    }

    public function removeStyle(Style $style): static
    {
        $this->styles->removeElement($style);
        $style->removeGroupe($this);

        return $this;
    }

    /**
     * @return Collection<int, Membre>
     */
    public function getMembres(): Collection
    {
        return $this->membres;
    }

    public function addMembre(Membre $membre): static
    {
        if (!$this->membres->contains($membre)) {
            $this->membres->add($membre);
            $membre->setGroupe($this);
        }

        return $this;
    }

    public function removeMembre(Membre $membre): static
    {
        if ($this->membres->removeElement($membre)) {
            // set the owning side to null (unless already changed)
            if ($membre->getGroupe() === $this) {
                $membre->setGroupe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Spectateur>
     */
    public function getSpectateursFavoris(): Collection
    {
        return $this->spectateursFavoris;
    }

    public function addSpectateursFavori(Spectateur $spectateursFavori): static
    {
        if (!$this->spectateursFavoris->contains($spectateursFavori)) {
            $this->spectateursFavoris->add($spectateursFavori);
            $spectateursFavori->addGroupeFavori($this);
        }

        return $this;
    }

    public function removeSpectateursFavori(Spectateur $spectateursFavori): static
    {
        if ($this->spectateursFavoris->removeElement($spectateursFavori)) {
            $spectateursFavori->removeGroupeFavori($this);
        }

        return $this;
    }
}
