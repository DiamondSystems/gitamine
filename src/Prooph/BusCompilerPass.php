<?php

declare(strict_types=1);

namespace App\Prooph;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class SynchronousQueryBusCompilerPass.
 */
final class BusCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container): void
    {
        $container->getDefinition('prooph_service_bus.gitamine_query_bus')
                  ->setClass(QueryBus::class)
                  ->setAutowired(true);
        $container->getDefinition('prooph_service_bus.gitamine_command_bus')
                  ->setClass(CommandBus::class)
                  ->setAutowired(true);
    }
}
