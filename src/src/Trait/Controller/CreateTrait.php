<?php

namespace SymfonyApiBase\Trait\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyApiBase\Controller\AbstractController;
use SymfonyApiBase\Exception\UnauthorizedException;
use SymfonyApiBase\Service\AuthService;
use SymfonyApiBase\Util\StringUtil;

/**
 * Добавляет rout создания сущности POST ".../{controller}"
 */
trait CreateTrait
{
    #[Route('', methods: 'POST')]
    public function create(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $userId = AuthService::getCurrentUserId();
        if (!$userId) {
            throw new NotFoundException();
        }

        $entity = new $this->entityClass();

        $fields = json_decode($request->getContent(), true);

        $fields['user_id'] = $userId;
        foreach ($fields as $field => $value) {
            $getter = 'set' . StringUtil::toCamelCase($field, true);
            $entity->{$getter}($value);
        }

        $entityManager->persist($entity);
        $entityManager->flush();

        return $this->prepareItem($entity);
    }
}