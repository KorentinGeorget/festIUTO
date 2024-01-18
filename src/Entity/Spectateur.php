<?php

namespace App\Entity;

use App\Repository\SpectateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpectateurRepository::class)]
class Spectateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nom = null;

    #[ORM\Column(length: 20)]
    private ?string $prenom = null;

    #[ORM\OneToMany(mappedBy: 'spectateur', targetEntity: PossedeBillet::class, orphanRemoval: true)]
    private Collection $billets;

    #[ORM\ManyToMany(targetEntity: Evenement::class, mappedBy: 'spectateurs')]
    private Collection $evenements;

    #[ORM\ManyToMany(targetEntity: Groupe::class, inversedBy: 'spectateursFavoris')]
    private Collection $groupeFavoris;

    #[ORM\OneToOne(mappedBy: 'spectateur', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function __construct()
    {
        $this->billets = new ArrayCollection();
        $this->evenements = new ArrayCollection();
        $this->groupeFavoris = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, PossedeBillet>
     */
    public function getBillets(): Collection
    {
        return $this->billets;
    }

    public function addBillet(PossedeBillet $billet): static
    {
        if (!$this->billets->contains($billet)) {
            $this->billets->add($billet);
            $billet->setSpectateur($this);
        }

        return $this;
    }

    public function removeBillet(PossedeBillet $billet): static
    {
        if ($this->billets->removeElement($billet)) {
            // set the owning side to null (unless already changed)
            if ($billet->getSpectateur() === $this) {
                $billet->setSpectateur(null);
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
            $evenement->addSpectateur($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): static
    {
        if ($this->evenements->removeElement($evenement)) {
            $evenement->removeSpectateur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Groupe>
     */
    public function getGroupeFavoris(): Collection
    {
        return $this->groupeFavoris;
    }

    public function addGroupeFavori(Groupe $groupeFavori): static
    {
        if (!$this->groupeFavoris->contains($groupeFavori)) {
            $this->groupeFavoris->add($groupeFavori);
            $groupeFavori->addSpectateursFavori($this);
        }

        return $this;
    }

    public function removeGroupeFavori(Groupe $groupeFavori): static
    {
        $this->groupeFavoris->removeElement($groupeFavori);
        $groupeFavori->removeSpectateursFavori($this);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setSpectateur(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getSpectateur() !== $this) {
            $user->setSpectateur($this);
        }

        $this->user = $user;

        return $this;
    }
}
