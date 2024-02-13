<?php

namespace SymfonyApiBase\Trait\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyApiBase\Controller\AbstractController;
use SymfonyApiBase\Exception\NotFoundException;

/**
 * Добавляет rout получения сущности GET ".../{controller}/{id|slug}"
 */
trait ReadTrait
{
    #[Route('/{id}', requirements: ['id' => '\d+'], methods: 'GET')]
    #[Route('/{slug}', requirements: ['slug' => '\w+'], methods: 'GET', )]
    public function read(Request $request, ?string $slug, ?int $id): JsonResponse
    {
        /** @var $this AbstractController */
        $entity = $id
            ? $this->repo->find($id)
            : $this->repo->findOneBy(['slug' => $slug]);

        if (!$entity) {
            throw new NotFoundException();
        }

        $fields = $this->getParameterFields($request);
        return $this->prepareItem($entity, $fields);
    }
}