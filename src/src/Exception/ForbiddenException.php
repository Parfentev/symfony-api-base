<?php

namespace SymfonyApiBase\Exception;

use Symfony\Component\HttpFoundation\Response;

class ForbiddenException extends \RuntimeException
{
    /** @var int */
    protected $code = 6;
    /** @var string */
    protected $message = 'Нет прав для выполнения данного действия.';
    public int $statusCode = Response::HTTP_FORBIDDEN;
}