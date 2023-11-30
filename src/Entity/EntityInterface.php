<?php

namespace SymfonyApiBase\Entity;

interface EntityInterface
{
    public function toArray(?array $fields = null): array;
}