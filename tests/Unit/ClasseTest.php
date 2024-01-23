<?php

namespace App\Tests\Entity;

use App\Entity\Classe;
use App\Entity\Matiere;
use App\Entity\Niveau;
use App\Entity\Professeur;
use App\Entity\Question;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class ClasseTest extends TestCase
{
    public function testConstructor()
    {
        $classe = new Classe();
        $this->assertInstanceOf(Classe::class, $classe);
        $this->assertInstanceOf(ArrayCollection::class, $classe->getQuestion());
        $this->assertInstanceOf(ArrayCollection::class, $classe->getMatieres());
        $this->assertInstanceOf(ArrayCollection::class, $classe->getProfesseurs());
    }

    public function testGetId(): void
    {
        $classe = new Classe();
        $this->assertNull($classe->getId());
    }

    public function testGetSetNom()
    {
        $classe = new Classe();
        $classe->setNom('6èmeA');
        $this->assertEquals('6èmeA', $classe->getNom());
    }

    public function testAddGetQuestion()
    {
        $classe = new Classe();
        $question = new Question();
        $classe->addQuestion($question);
        $this->assertCount(1, $classe->getQuestion());
        $this->assertContains($question, $classe->getQuestion());
    }

    public function testRemoveQuestion()
    {
        $classe = new Classe();
        $question = new Question();
        $classe->addQuestion($question);
        $classe->removeQuestion($question);
        $this->assertCount(0, $classe->getQuestion());
    }

    public function testAddGetMatieres()
    {
        $classe = new Classe();
        $matiere = new Matiere();
        $classe->addMatiere($matiere);
        $this->assertCount(1, $classe->getMatieres());
        $this->assertContains($matiere, $classe->getMatieres());
    }

    public function testRemoveMatiere()
    {
        $classe = new Classe();
        $matiere = new Matiere();
        $classe->addMatiere($matiere);
        $classe->removeMatiere($matiere);
        $this->assertCount(0, $classe->getMatieres());
    }

    public function testGetSetNiveau()
    {
        $classe = new Classe();
        $niveau = new Niveau();
        $classe->setNiveau($niveau);
        $this->assertEquals($niveau, $classe->getNiveau());
    }

    public function testAddGetProfesseurs()
    {
        $classe = new Classe();
        $professeur = new Professeur();
        $classe->addProfesseur($professeur);
        $this->assertCount(1, $classe->getProfesseurs());
        $this->assertContains($professeur, $classe->getProfesseurs());
    }

    public function testRemoveProfesseur()
    {
        $classe = new Classe();
        $professeur = new Professeur();
        $classe->addProfesseur($professeur);
        $classe->removeProfesseur($professeur);
        $this->assertCount(0, $classe->getProfesseurs());
    }
}
