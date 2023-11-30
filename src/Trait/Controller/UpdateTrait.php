<?php

namespace SymfonyApiBase\Trait\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyApiBase\Controller\V1\AbstractController;
use SymfonyApiBase\Util\StringUtil;

/**
 * Добавляет rout обновления сущности PATCH ".../{controller}/{id}"
 */
trait UpdateTrait
{
    #[Route('/{id}', requirements: ['id' => '\d+'], methods: 'PATCH')]
    public function update(EntityManagerInterface $entityManager, Request $request, int $id): JsonResponse
    {
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