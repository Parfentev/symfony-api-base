<?php

namespace SymfonyApiBase\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class SymfonyApiBaseExtension extends Extension implements PrependExtensionInterface
{

    public function load(array $configs, ContainerBuilder $container): void
    {
        //$configuration = new Configuration();
       // $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../config')
        );
     //  $loader->load('services.yaml');
       // $loader->load('routes/base_api.yaml');

        // Сохранение конфигурации в параметры Symfony
       // $container->setParameter('api_base.endpoints', $config['endpoints']);
       // $container->setParameter('api_base.errors_in_json', $config['errors_in_json']);

        // Регистрация контроллеров
       // if ($config['register_controllers']['user']) {
       //     $container->register('app.your_bundle.user_controller', UserController::class)
       //         ->addTag('controller.service_arguments');
       // }

       // $t='sd';
    }

    public function prepend(ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../config')
        );
      //  $loader->load('routes.yaml');
    }

    public function getAlias(): string
    {
        return 'api_base';
    }
}