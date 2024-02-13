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
 * Добавляет rout обновления сущности PATCH ".../{controller}/{id}"
 */
trait UpdateTrait
{
    #[Route('/{id}', requirements: ['id' => '\d+'], methods: 'PATCH')]
    public function update(EntityManagerInterface $entityManager, Request $request, int $id): JsonResponse
    {
        $userId = AuthService::getCurrentUserId();
        if (!$userId) {
            throw new UnauthorizedException();
        }

        /** @var $this AbstractController */
        $entity = $this->repo->find($id);

        $fields = json_decode($request->getContent(), true);

        foreach ($fields as $field => $value) {
            $getter       = 'set' . StringUtil::toCamelCase($field, true);
            $entity->{$getter}($value);
        }

        $entityManager->flush();

        return $this->prepareItem($entity);
    }
}