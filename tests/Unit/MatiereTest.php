<?php

namespace App\Tests\Entity;

use App\Entity\Classe;
use App\Entity\Matiere;
use App\Entity\Professeur;
use App\Entity\Question;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class MatiereTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $matiere = new Matiere();
        $matiere->setNom('Math');
        $this->assertEquals('Math', $matiere->getNom());
        $this->assertNull($matiere->getId());
    }

    public function testAddAndRemoveClasse(): void
    {
        $matiere = new Matiere();
        $classe = new Classe();
        $matiere->addClasse($classe);
        $this->assertTrue($matiere->getClasse()->contains($classe));
        $matiere->removeClasse($classe);
        $this->assertFalse($matiere->getClasse()->contains($classe));
    }

    public function testAddAndRemoveProfesseur(): void
    {
        $matiere = new Matiere();
        $professeur = new Professeur();
        $matiere->addProfesseur($professeur);
        $this->assertTrue($matiere->getProfesseur()->contains($professeur));
        $this->assertEquals($matiere, $professeur->getMatiere());
        $matiere->removeProfesseur($professeur);
        $this->assertFalse($matiere->getProfesseur()->contains($professeur));
        $this->assertNull($professeur->getMatiere());
    }

    public function testAddAndRemoveQuestion(): void
    {
        $matiere = new Matiere();
        $question = new Question();
        $matiere->addQuestion($question);
        $this->assertTrue($matiere->getQuestions()->contains($question));
        $this->assertEquals($matiere, $question->getMatiere());
        $matiere->removeQuestion($question);
        $this->assertFalse($matiere->getQuestions()->contains($question));
        $this->assertNull($question->getMatiere());
    }

    public function testToString(): void
    {
        $matiere = new Matiere();
        $matiere->setNom('Math');
        $this->assertEquals('Math', (string) $matiere);
    }
}
