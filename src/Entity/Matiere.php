<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatiereRepository::class)]
class Matiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: Classe::class, inversedBy: 'matieres')]
    private Collection $classe;

    #[ORM\OneToMany(mappedBy: 'matiere', targetEntity: Professeur::class)]
    private Collection $professeur;

    public function __construct()
    {
        $this->classe = new ArrayCollection();
        $this->professeur = new ArrayCollection();
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

    /**
     * @return Collection<int, Classe>
     */
    public function getClasse(): Collection
    {
        return $this->classe;
    }

    public function addClasse(Classe $classe): static
    {
        if (!$this->classe->contains($classe)) {
            $this->classe->add($classe);
        }

        return $this;
    }

    public function removeClasse(Classe $classe): static
    {
        $this->classe->removeElement($classe);

        return $this;
    }

    /**
     * @return Collection<int, Professeur>
     */
    public function getProfesseur(): Collection
    {
        return $this->professeur;
    }

    public function addProfesseur(Professeur $professeur): static
    {
        if (!$this->professeur->contains($professeur)) {
            $this->professeur->add($professeur);
            $professeur->setMatiere($this);
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): static
    {
        if ($this->professeur->removeElement($professeur)) {
            // set the owning side to null (unless already changed)
            if ($professeur->getMatiere() === $this) {
                $professeur->setMatiere(null);
            }
        }

        return $this;
    }
}
