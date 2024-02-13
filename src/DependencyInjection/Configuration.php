<?php

namespace SymfonyApiBase\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('api_base');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('endpoints')
                    ->children()
                        ->booleanNode('users')->defaultTrue()->end()
                        ->booleanNode('auth')->defaultTrue()->end()
                    ->end()
                ->end()
                ->booleanNode('errors_in_json')->defaultTrue()->end()
            ->end();

        return $treeBuilder;
    }
}