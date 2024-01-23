<?php

namespace App\Tests\Entity;

use App\Entity\Classe;
use App\Entity\Matiere;
use App\Entity\Professeur;
use App\Entity\Question;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class ProfesseurTest extends TestCase
{
    public function testConstruct(): void
    {
        $professeur = new Professeur();
        $this->assertInstanceOf(Professeur::class, $professeur);
        $this->assertInstanceOf(ArrayCollection::class, $professeur->getQuestions());
        $this->assertInstanceOf(ArrayCollection::class, $professeur->getQuestionsSupprimes());
        $this->assertInstanceOf(ArrayCollection::class, $professeur->getClasses());
    }

    public function testGetId(): void
    {
        $professeur = new Professeur();
        $this->assertNull($professeur->getId());
    }

    public function testGetSetNom(): void
    {
        $professeur = new Professeur();
        $professeur->setNom('John Doe');
        $this->assertEquals('John Doe', $professeur->getNom());
    }

    public function testGetSetCode(): void
    {
        $professeur = new Professeur();
        $professeur->setCode(123);
        $this->assertEquals(123, $professeur->getCode());
    }

    public function testAddGetRemoveQuestion(): void
    {
        $professeur = new Professeur();
        $question = new Question();
        $professeur->addQuestion($question);
        $this->assertCount(1, $professeur->getQuestions());
        $professeur->removeQuestion($question);
        $this->assertCount(0, $professeur->getQuestions());
    }

    public function testAddGetRemoveQuestionsSupprimes(): void
    {
        $professeur = new Professeur();
        $question = new Question();
        $professeur->addQuestionsSupprime($question);
        $this->assertCount(1, $professeur->getQuestionsSupprimes());
        $professeur->removeQuestionsSupprime($question);
        $this->assertCount(0, $professeur->getQuestionsSupprimes());
    }

    public function testGetSetMatiere(): void
    {
        $professeur = new Professeur();
        $matiere = new Matiere();
        $professeur->setMatiere($matiere);
        $this->assertEquals($matiere, $professeur->getMatiere());
    }

    public function testAddGetRemoveClasse(): void
    {
        $professeur = new Professeur();
        $classe = new Classe();
        $professeur->addClasse($classe);
        $this->assertCount(1, $professeur->getClasses());
        $professeur->removeClasse($classe);
        $this->assertCount(0, $professeur->getClasses());
    }

    public function testHasClasse(): void
    {
        $professeur = new Professeur();
        $classe = new Classe();
        $professeur->addClasse($classe);
        $this->assertTrue($professeur->hasClasse($classe));
        $professeur->removeClasse($classe);
        $this->assertFalse($professeur->hasClasse($classe));
    }
}
