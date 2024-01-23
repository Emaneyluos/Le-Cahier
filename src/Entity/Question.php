<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['question:read'])]
    private ?int $id = null;

    // TODO: add a cron for check that
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups(['question:read'])]
    private ?\DateTimeInterface $dateValidite = null;

    #[ORM\Column]
    private ?bool $Signalement = null;

    #[ORM\ManyToOne(inversedBy: 'question')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['question:read'])]
    private ?Classe $classe = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[Groups(['question:read'])]
    private ?Professeur $professeur = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['question:read'])]
    private ?string $question = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['question:read'])]
    private ?string $reponse = null;

    #[ORM\Column]
    private ?bool $visible = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: DateReponse::class, orphanRemoval: true)]
    private Collection $dateReponses;

    #[ORM\ManyToOne(inversedBy: 'questionsSupprimes')]
    private ?Professeur $supprimerPar = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['question:read'])]
    private ?\DateTimeInterface $creeeLe = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $modifieLe = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['question:read'])]
    private ?Matiere $matiere = null;

    public function __construct()
    {
        $this->dateReponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateValidite(): ?\DateTimeInterface
    {
        return $this->dateValidite;
    }

    public function setDateValidite(?\DateTimeInterface $dateValidite): static
    {
        $this->dateValidite = $dateValidite;

        return $this;
    }

    public function isSignalement(): ?bool
    {
        return $this->Signalement;
    }

    public function setSignalement(bool $Signalement): static
    {
        $this->Signalement = $Signalement;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(?Professeur $professeur): static
    {
        $this->professeur = $professeur;

        return $this;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): static
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function isVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): static
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * @return Collection<int, DateReponse>
     */
    public function getDateReponses(): Collection
    {
        return $this->dateReponses;
    }

    public function addDateReponse(DateReponse $dateReponse): static
    {
        if (!$this->dateReponses->contains($dateReponse)) {
            $this->dateReponses->add($dateReponse);
            $dateReponse->setQuestion($this);
        }

        return $this;
    }

    #[Groups(['question:read'])]
    public function getLastDateReponse(): ?DateTimeInterface
    {
        $dateReponses = $this->getDateReponses()->toArray();
        if (empty($dateReponses)) {
            return null;
        }
        return end($dateReponses)->getDate();
    }

    public function removeDateReponse(DateReponse $dateReponse): static
    {
        if ($this->dateReponses->removeElement($dateReponse)) {
            // set the owning side to null (unless already changed)
            if ($dateReponse->getQuestion() === $this) {
                $dateReponse->setQuestion(null);
            }
        }

        return $this;
    }

    public function getSupprimerPar(): ?Professeur
    {
        return $this->supprimerPar;
    }

    public function setSupprimerPar(?Professeur $supprimerPar): static
    {
        $this->supprimerPar = $supprimerPar;

        return $this;
    }

    public function getCreeeLe(): ?\DateTimeInterface
    {
        return $this->creeeLe;
    }

    public function setCreeeLe(\DateTimeInterface $creerLe): static
    {
        $this->creeeLe = $creerLe;

        return $this;
    }

    public function getModifieLe(): ?\DateTimeInterface
    {
        return $this->modifieLe;
    }

    public function setModifieLe(\DateTimeInterface $modifieLe): static
    {
        $this->modifieLe = $modifieLe;

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
