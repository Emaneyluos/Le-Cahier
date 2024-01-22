<?php

namespace App\Entity;

use App\Entity\Classe;
use App\Entity\DateReponse;
use App\Entity\Matiere;
use App\Entity\Professeur;
use App\Entity\Question;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class QuestionTest extends TestCase
{
    public function testConstruct(): void
    {
        $question = new Question();
        $this->assertInstanceOf(Question::class, $question);
        $this->assertInstanceOf(ArrayCollection::class, $question->getDateReponses());
    }

    public function testGetId(): void
    {
        $question = new Question();
        $this->assertNull($question->getId());
    }

    public function testGetDateValidite(): void
    {
        $date = new DateTime();
        $question = new Question();
        $question->setDateValidite($date);
        $this->assertEquals($date, $question->getDateValidite());
    }

    public function testIsSignalement(): void
    {
        $question = new Question();
        $question->setSignalement(true);
        $this->assertTrue($question->isSignalement());
    }

    public function testGetClasse(): void
    {
        $classe = new Classe();
        $question = new Question();
        $question->setClasse($classe);
        $this->assertEquals($classe, $question->getClasse());
    }

    public function testGetProfesseur(): void
    {
        $professeur = new Professeur();
        $question = new Question();
        $question->setProfesseur($professeur);
        $this->assertEquals($professeur, $question->getProfesseur());
    }

    public function testGetQuestion(): void
    {
        $question = new Question();
        $question->setQuestion('This is a question');
        $this->assertEquals('This is a question', $question->getQuestion());
    }

    public function testGetReponse(): void
    {
        $question = new Question();
        $question->setReponse('This is a response');
        $this->assertEquals('This is a response', $question->getReponse());
    }

    public function testIsVisible(): void
    {
        $question = new Question();
        $question->setVisible(true);
        $this->assertTrue($question->isVisible());
    }

    public function testGetDateReponses(): void
    {
        $date1 = new DateTime();
        $date2 = new DateTime('+1 day');

        $question = new Question();

        $dateReponse1 = new DateReponse();
        $dateReponse1->setEstCorrect(true);
        $dateReponse1->setDate($date1);

        $dateReponse2 = new DateReponse();
        $dateReponse2->setEstCorrect(false);
        $dateReponse2->setDate($date2);

        $question->addDateReponse($dateReponse1);
        $question->addDateReponse($dateReponse2);

        $allDateReponse = $question->getDateReponses();

        $this->assertCount(2, $allDateReponse);
        $this->assertEquals($date1, $allDateReponse[0]->getDate());
        $this->assertEquals($date2, $allDateReponse[1]->getDate());
        $this->assertTrue($allDateReponse[0]->isEstCorrect());
        $this->assertFalse($allDateReponse[1]->isEstCorrect());
    }

    public function testGetLastDateReponse(): void
    {
        $date1 = new DateTime();
        $date2 = new DateTime('+1 day');

        $question = new Question();

        $dateReponse1 = new DateReponse();
        $dateReponse1->setEstCorrect(true);
        $dateReponse1->setDate($date1);

        $dateReponse2 = new DateReponse();
        $dateReponse2->setEstCorrect(false);
        $dateReponse2->setDate($date2);

        $question->addDateReponse($dateReponse1);
        $question->addDateReponse($dateReponse2);

        $this->assertEquals($date2, $question->getLastDateReponse());
    }

    public function testRemoveDateReponse(): void
    {
        $dateReponse = new DateReponse();
        $question = new Question();
        $question->addDateReponse($dateReponse);
        $this->assertCount(1, $question->getDateReponses());
        $question->removeDateReponse($dateReponse);
        $this->assertCount(0, $question->getDateReponses());
    }

    public function testGetSupprimerPar(): void
    {
        $professeur = new Professeur();
        $question = new Question();
        $question->setSupprimerPar($professeur);
        $this->assertEquals($professeur, $question->getSupprimerPar());
    }

    public function testGetCreeeLe(): void
    {
        $date = new DateTime();
        $question = new Question();
        $question->setCreeeLe($date);
        $this->assertEquals($date, $question->getCreeeLe());
    }

    public function testGetModifieLe(): void
    {
        $date = new DateTime();
        $question = new Question();
        $question->setModifieLe($date);
        $this->assertEquals($date, $question->getModifieLe());
    }

    public function testGetMatiere(): void
    {
        $matiere = new Matiere();
        $question = new Question();
        $question->setMatiere($matiere);
        $this->assertEquals($matiere, $question->getMatiere());
    }
}