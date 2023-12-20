<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Question;
use App\Entity\Classe;
use App\Entity\Niveau;
use Doctrine\ORM\Mapping\Id;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Niveau::class);
        $niveaux = $repository->findBy([], ['position' => 'ASC']);

        $repository = $entityManager->getRepository(Question::class);
        $questions = $repository->findBy([], ['creeeLe' => 'DESC']);

        $repository = $entityManager->getRepository(Classe::class);
        $classeId = $repository->findAll()[0];

        return $this->render('question/index.html.twig', [
            'questions' => $questions,
            'niveaux' => $niveaux,
            'classeId' => $classeId,
        ]);

    }
}
