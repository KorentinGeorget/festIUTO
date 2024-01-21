<?php

namespace App\Entity;

use App\Repository\StyleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StyleRepository::class)]
class Style
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nomStyle = null;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'stylesSimilaires')]
    private Collection $styleSimilaires;

    #[ORM\ManyToMany(targetEntity: Groupe::class, mappedBy: 'styles')]
    private Collection $groupes;


    public function __construct()
    {
        $this->styleSimilaires = new ArrayCollection();
        $this->groupes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomStyle(): ?string
    {
        return $this->nomStyle;
    }

    public function setNomStyle(string $nomStyle): static
    {
        $this->nomStyle = $nomStyle;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getStyleSimilaires(): Collection
    {
        return $this->styleSimilaires;
    }

    public function addStyleSimilaire(self $styleSimilaire): static
    {
        if (!$this->styleSimilaires->contains($styleSimilaire)) {
            $this->styleSimilaires->add($styleSimilaire);
        }

        return $this;
    }

    public function removeStyleSimilaire(self $styleSimilaire): static
    {
        $this->styleSimilaires->removeElement($styleSimilaire);

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
            $groupe->addStyle($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): static
    {
        if ($this->groupes->removeElement($groupe)) {
            $groupe->removeStyle($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nomStyle;
    }
}
