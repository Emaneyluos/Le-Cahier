<?php

namespace App\Tests\Entity;

use App\Entity\DateReponse;
use App\Entity\Question;
use PHPUnit\Framework\TestCase;

class DateReponseTest extends TestCase
{
    public function testConstructor(): void
    {
        $dateReponse = new DateReponse();
        $this->assertInstanceOf(DateReponse::class, $dateReponse);
    }

    public function testGetId(): void
    {
        $dateReponse = new DateReponse();
        $this->assertNull($dateReponse->getId());
    }

    public function testGetDate(): void
    {
        $date = new \DateTimeImmutable();
        $dateReponse = new DateReponse();
        $this->assertNull($dateReponse->getDate());

        $dateReponse->setDate($date);
        $this->assertSame($date, $dateReponse->getDate());
    }

    public function testIsEstCorrect(): void
    {
        $dateReponse = new DateReponse();
        $this->assertNull($dateReponse->isEstCorrect());

        $dateReponse->setEstCorrect(true);
        $this->assertTrue($dateReponse->isEstCorrect());

        $dateReponse->setEstCorrect(false);
        $this->assertFalse($dateReponse->isEstCorrect());
    }

    public function testGetQuestion(): void
    {
        $question = new Question();
        $dateReponse = new DateReponse();
        $this->assertNull($dateReponse->getQuestion());

        $dateReponse->setQuestion($question);
        $this->assertSame($question, $dateReponse->getQuestion());
    }

    public function testSetDate(): void
    {
        $date = new \DateTimeImmutable();
        $dateReponse = new DateReponse();

        $this->assertSame($dateReponse, $dateReponse->setDate($date));
        $this->assertSame($date, $dateReponse->getDate());
    }

    public function testSetEstCorrect(): void
    {
        $dateReponse = new DateReponse();

        $this->assertSame($dateReponse, $dateReponse->setEstCorrect(true));
        $this->assertTrue($dateReponse->isEstCorrect());

        $this->assertSame($dateReponse, $dateReponse->setEstCorrect(false));
        $this->assertFalse($dateReponse->isEstCorrect());
    }

    public function testSetQuestion(): void
    {
        $question = new Question();
        $dateReponse = new DateReponse();

        $this->assertSame($dateReponse, $dateReponse->setQuestion($question));
        $this->assertSame($question, $dateReponse->getQuestion());
    }
}
