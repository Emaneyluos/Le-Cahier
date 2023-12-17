<?php

namespace App\Controller;

use App\Entity\Niveau;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Question;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Niveau::class);
        $niveaux = $repository->findBy([], ['position' => 'ASC']);

        $repository = $entityManager->getRepository(Question::class);
        $questions = $repository->findBy([], ['creeeLe' => 'DESC']);

        return $this->render('question/index.html.twig', [
            'questions' => $questions,
            'niveaux' => $niveaux,
        ]);

    }
}
