<?php

namespace App\Entity;

use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
class Professeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['question:read'])]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $code = null;

    #[ORM\OneToMany(mappedBy: 'professeur', targetEntity: Question::class)]
    private Collection $questions;

    #[ORM\OneToMany(mappedBy: 'supprimerPar', targetEntity: Question::class)]
    private Collection $questionsSupprimes;

    #[ORM\ManyToOne(inversedBy: 'professeur')]
    private ?Matiere $matiere = null;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->questionsSupprimes = new ArrayCollection();
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

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): static
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setProfesseur($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getProfesseur() === $this) {
                $question->setProfesseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestionsSupprimes(): Collection
    {
        return $this->questionsSupprimes;
    }

    public function addQuestionsSupprime(Question $questionsSupprime): static
    {
        if (!$this->questionsSupprimes->contains($questionsSupprime)) {
            $this->questionsSupprimes->add($questionsSupprime);
            $questionsSupprime->setSupprimerPar($this);
        }

        return $this;
    }

    public function removeQuestionsSupprime(Question $questionsSupprime): static
    {
        if ($this->questionsSupprimes->removeElement($questionsSupprime)) {
            // set the owning side to null (unless already changed)
            if ($questionsSupprime->getSupprimerPar() === $this) {
                $questionsSupprime->setSupprimerPar(null);
            }
        }

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): static
    {
        $this->matiere = $matiere;

        return $this;
    }
}
