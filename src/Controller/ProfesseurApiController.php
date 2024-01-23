<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Professeur;

// TODO: Protéger contre les appels en brut force

class ProfesseurApiController extends AbstractController
{
    #[Route('/api/professeur/classes/{professeurCode}', name: 'professeur_classes_api', methods: ['GET'])]
    public function getQuestionByClasse(
        int $professeurCode,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer
    ): JsonResponse {
        $repository = $entityManager->getRepository(Professeur::class);

        $sanitizedProfesseurCode = filter_var($professeurCode, FILTER_SANITIZE_NUMBER_INT);
        $professeur = $repository->findOneBy(['code' => $sanitizedProfesseurCode]);

        if ($professeur == null) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }

        $classes = $professeur->getClasses();

        $json = $serializer->serialize($classes, 'json', [
            'groups' => 'professeur_classe:read'
        ]);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }
}
