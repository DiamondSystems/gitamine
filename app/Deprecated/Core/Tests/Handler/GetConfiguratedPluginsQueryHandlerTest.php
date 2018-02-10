<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Tests\Handler;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Deprecated\Core\Query\Handler\GetConfiguratedPluginsQueryHandler;
use Gitamine\Deprecated\Core\Query\GetConfiguratedPluginsQuery;
use Gitamine\Deprecated\Core\Query\GetProjectDirectoryQuery;
use Gitamine\Deprecated\Core\Test\GitamineMock;
use Gitamine\Deprecated\Core\Test\QueryBusMock;

/**
 * Class GetConfiguratedPluginsQueryHandlerTest.
 *
 * @coversNothing
 */
class GetConfiguratedPluginsQueryHandlerTest extends TestCase
{
    public function testGetConfiguratedPlugins(): void
    {
        $dir      = '/';
        $bus      = QueryBusMock::create();
        $gitamine = GitamineMock::create();

        $bus->shouldDispatch(new GetProjectDirectoryQuery(), $dir);
        $gitamine->shouldGetPluginList($dir, 'pre-commit', ['test']);

        $handler = new GetConfiguratedPluginsQueryHandler($bus->bus(), $gitamine->gitamine());

        self::assertEquals(
            ['test'],
            $handler(new GetConfiguratedPluginsQuery('pre-commit'))
        );
    }
}
