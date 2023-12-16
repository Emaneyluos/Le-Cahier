<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Classe;
use App\Entity\Niveau;
use App\Entity\Matiere;
use App\Entity\Professeur;
use App\Entity\Question;
use App\Entity\DateReponse;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function __construct(ObjectManager $entityManager)
    {
        // Remove the unused property $entityManager
    }
    
    public function load(ObjectManager $manager): void
    {

        $niveau6 = new Niveau();
        $niveau6->setNom('6ème');
        $niveau5 = new Niveau();
        $niveau5->setNom('5ème');
        $niveau4 = new Niveau();
        $niveau4->setNom('4ème');
        $niveau3 = new Niveau();
        $niveau3->setNom('3ème');

        $classes = [];
        $classe6A = new Classe();
        $classe6A->setNom('6ème A');
        $classe6A->setNiveau($niveau6);
        $classes[] = $classe6A;

        $classe6B = new Classe();
        $classe6B->setNom('6ème B');
        $classe6B->setNiveau($niveau6);
        $classes[] = $classe6B;

        $classe6C = new Classe();
        $classe6C->setNom('6ème C');
        $classe6C->setNiveau($niveau6);
        $classes[] = $classe6C;

        $classe6D = new Classe();
        $classe6D->setNom('6ème D');
        $classe6D->setNiveau($niveau6);
        $classes[] = $classe6D;

        $classe5A = new Classe();
        $classe5A->setNom('5ème A');
        $classe5A->setNiveau($niveau5);
        $classes[] = $classe5A;


        $classe5B = new Classe();
        $classe5B->setNom('5ème B');
        $classe5B->setNiveau($niveau5);
        $classes[] = $classe5B;

        $classe5C = new Classe();
        $classe5C->setNom('5ème C');
        $classe5C->setNiveau($niveau5);
        $classes[] = $classe5C;

        $classe5D = new Classe();
        $classe5D->setNom('5ème D');
        $classe5D->setNiveau($niveau5);
        $classes[] = $classe5D;

        $classe4A = new Classe();
        $classe4A->setNom('4ème A');
        $classe4A->setNiveau($niveau4);
        $classes[] = $classe4A;

        $classe4B = new Classe();
        $classe4B->setNom('4ème B');
        $classe4B->setNiveau($niveau4);
        $classes[] = $classe4B;

        $classe4C = new Classe();
        $classe4C->setNom('4ème C');
        $classe4C->setNiveau($niveau4);
        $classes[] = $classe4C;

        $classe4D = new Classe();
        $classe4D->setNom('4ème D');
        $classe4D->setNiveau($niveau4);
        $classes[] = $classe4D;

        $classe3A = new Classe();
        $classe3A->setNom('3ème A');
        $classe3A->setNiveau($niveau3);
        $classes[] = $classe3A;

        $classe3B = new Classe();
        $classe3B->setNom('3ème B');
        $classe3B->setNiveau($niveau3);
        $classes[] = $classe3B;

        $classe3C = new Classe();
        $classe3C->setNom('3ème C');
        $classe3C->setNiveau($niveau3);
        $classes[] = $classe3C;

        $classe3D = new Classe();
        $classe3D->setNom('3ème D');
        $classe3D->setNiveau($niveau3);
        $classes[] = $classe3D;


        $maths = new Matiere();
        $maths->setNom('Mathématiques');

        $histoire = new Matiere();
        $histoire->setNom('Histoire');

        $geographie = new Matiere();
        $geographie->setNom('Géographie');

        $sciences = new Matiere();
        $sciences->setNom('Sciences');

        $francais = new Matiere();
        $francais->setNom('Français');

        $anglais = new Matiere();
        $anglais->setNom('Anglais');
        

        
        $profMaths = new Professeur();
        $profMaths
            ->setNom('Mr. Dupont')
            ->setMatiere($maths);

        $profHistoire = new Professeur();
        $profHistoire
            ->setNom('Ms. Durand')
            ->setMatiere($histoire);
        
        $profGeographie = new Professeur();
        $profGeographie
            ->setNom('Mme. Martin')
            ->setMatiere($geographie);

        $profSciences = new Professeur();
        $profSciences
            ->setNom('Mr. Lefevre')
            ->setMatiere($sciences);

        $profFrancais = new Professeur();
        $profFrancais
            ->setNom('Mme. Dubois')
            ->setMatiere($francais);

        $profAnglais = new Professeur();
        $profAnglais
            ->setNom('Mr. Smith')
            ->setMatiere($anglais);
        

        $professeursParMatiere = [
            $maths => $profMaths,
            $histoire => $profHistoire,
            $geographie => $profGeographie,
            $sciences => $profSciences,
            $francais => $profFrancais,
            $anglais => $profAnglais,
        ];
    
        // Create questions for each class and subject
        foreach ($classes as $classe) {
            foreach ([$maths, $histoire, $geographie, $sciences, $francais, $anglais] as $matiere) {
                $question = new Question();
                $professeur = $professeursParMatiere[$matiere->getNom()];
                $dateAleatoireCreation = date('Y-m-d', strtotime('-1 year'));
                $dateAleatoireValidite = date('Y-m-d', strtotime('+1 year'));

                $question
                    ->setClasse($classe)
                    ->setProfesseur($professeur)
                    ->setMatiere($matiere)
                    ->setCreerLe(new \DateTime($dateAleatoireCreation));

                if (rand(0, 1) === 0) {
                    $question->setDateValidite(new \DateTime($dateAleatoireValidite));
                }

                if ($matiere === $maths) {
                    $question
                        ->setQuestion('Quelle est la racine carrée de 4 ?')
                        ->setReponse('2');
                }
                elseif ($matiere === $histoire) {
                    $question
                        ->setQuestion('Quand a eu lieu la révolution française ?')
                        ->setReponse('1789');
                }
                elseif ($matiere === $geographie) {
                    $question
                        ->setQuestion('Quelle est la capitale de la France ?')
                        ->setReponse('Paris');
                }
                elseif ($matiere === $sciences) {
                    $question
                        ->setQuestion('Quel est le symbole de l\'eau ?')
                        ->setReponse('H2O');
                }
                elseif ($matiere === $francais) {
                    $question
                        ->setQuestion('Quel est le pluriel de "cheval" ?')
                        ->setReponse('chevaux');
                }
                elseif ($matiere === $anglais) {
                    $question
                        ->setQuestion('Comment dit-on "bonjour" en anglais ?')
                        ->setReponse('hello');
                }

                for ($i = 0; $i < rand(0, 5); $i++) {
                    $dateReponse = new DateReponse();

                    $today = new \DateTime();
                    $yesterday = $today->modify('-1 day');
                    $randomDate = new \DateTime();
                    $randomDate->setTimestamp($question->getCreerLe()->getTimestamp(), $yesterday->getTimestamp());

                    $question->setDateValidite($randomDate);
                    $dateReponse->setDate(new \DateTime('tomorrow'));
                    $question->addDateReponse($dateReponse);
                }

            }
        }

// ...


        

        // DateReponse Fixtures
        $dateReponse1 = new DateReponse();
        $dateReponse1->setDate(new \DateTime('tomorrow'));
        // ...

        // User Fixtures
        $userStudent = new User();
        $userStudent->setEmail('student@example.com');
        // ...


        $manager->flush();
    }
}
