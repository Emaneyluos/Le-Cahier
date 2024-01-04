<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Question;
use App\Entity\Classe;

// TODO: Protéger contre les appels en brut force

class QuestionApiController extends AbstractController
{

    /**
     * This api return the Question by Classse.
     * Order by date of creation and last response.
     *
     * @param Class classe 
     * @return JsonResponse
     */
    #[Route('/api/question/{classeId}', name: 'question_api', methods: ['GET'])]
    public function getQuestionByClasse(int $classeId, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $repository = $entityManager->getRepository(Classe::class);
        $classe = $repository->find($classeId);

        $repository = $entityManager->getRepository(Question::class);

        $questions = $repository->findBy(
            ['classe' => $classe, 'visible' => true],
        );

        $questionsRepondues = array_filter($questions, function ($question) {
            return $question->getDateReponses()->count() > 0;
        });

        usort($questionsRepondues, function ($a, $b) {
            return $b->getLastDateReponse() <=> $a->getLastDateReponse();
        });

        $questionsNonRepondues = array_filter($questions, function ($question) {
            return $question->getDateReponses()->count() == 0;
        });

        $json = $serializer->serialize($questionsRepondues, 'json', [
            'groups' => 'question:read'
        ]);
        
        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }
}
        
