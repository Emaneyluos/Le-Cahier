<?php

namespace App\Tests\Entity;

use App\Entity\Classe;
use App\Entity\Niveau;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class NiveauTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $niveau = new Niveau();

        $this->assertNull($niveau->getId());

        $nom = 'Test';
        $niveau->setNom($nom);
        $this->assertEquals($nom, $niveau->getNom());

        $position = 2;
        $niveau->setPosition($position);
        $this->assertEquals($position, $niveau->getPosition());
    }

    public function testAddRemoveClass(): void
    {
        $niveau = new Niveau();
        $classe = new Classe();

        $niveau->addClass($classe);
        $this->assertTrue($niveau->getClasses()->contains($classe));
        $this->assertEquals($niveau, $classe->getNiveau());

        $niveau->removeClass($classe);
        $this->assertFalse($niveau->getClasses()->contains($classe));
        $this->assertNull($classe->getNiveau());
    }

    public function testToString(): void
    {
        $niveau = new Niveau();
        $niveau->setNom('Test');
        $this->assertEquals('Test', (string) $niveau);
    }
}
