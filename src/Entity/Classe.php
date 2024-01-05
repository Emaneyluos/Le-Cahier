<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['question:read', 'professeur_classe:read'])]
    // #[Groups(['professeur_classe:read'])]
    private ?int $id = null;

    #[Groups(['question:read', 'professeur_classe:read'])]
    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Question::class, orphanRemoval: true)]
    private Collection $question;

    #[ORM\ManyToMany(targetEntity: Matiere::class, mappedBy: 'classe')]
    private Collection $matieres;

    #[ORM\ManyToOne(inversedBy: 'classes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Niveau $niveau = null;

    #[ORM\ManyToMany(targetEntity: Professeur::class, mappedBy: 'classes')]
    private Collection $professeurs;

    public function __construct()
    {
        $this->question = new ArrayCollection();
        $this->matieres = new ArrayCollection();
        $this->professeurs = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->nom;
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
     * @return Collection<int, Question>
     */
    public function getQuestion(): Collection
    {
        return $this->question;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->question->contains($question)) {
            $this->question->add($question);
            $question->setClasse($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        if ($this->question->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getClasse() === $this) {
                $question->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Matiere>
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matiere $matiere): static
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres->add($matiere);
            $matiere->addClasse($this);
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): static
    {
        if ($this->matieres->removeElement($matiere)) {
            $matiere->removeClasse($this);
        }

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection<int, Professeur>
     */
    public function getProfesseurs(): Collection
    {
        return $this->professeurs;
    }

    public function addProfesseur(Professeur $professeur): static
    {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs->add($professeur);
            $professeur->addClasse($this);
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): static
    {
        if ($this->professeurs->removeElement($professeur)) {
            $professeur->removeClasse($this);
        }

        return $this;
    }
}
