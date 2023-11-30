<?php

namespace SymfonyApiBase;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use SymfonyApiBase\DependencyInjection\SymfonyApiBaseExtension;

/**
 * Bundle.
 *
 * @author Ivan Parfentev
 */
final class SymfonyApiBaseBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return __DIR__;
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new SymfonyApiBaseExtension();
    }
}
