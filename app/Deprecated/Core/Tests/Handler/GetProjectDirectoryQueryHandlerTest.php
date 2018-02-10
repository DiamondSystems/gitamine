<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Tests\Handler;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Deprecated\Core\Query\Handler\GetProjectDirectoryQueryHandler;
use Gitamine\Deprecated\Core\Query\GetProjectDirectoryQuery;
use Gitamine\Deprecated\Core\Test\GitamineMock;

/**
 * Class GetProjectDirectoryQueryHandlerTest.
 *
 * @coversNothing
 */
class GetProjectDirectoryQueryHandlerTest extends TestCase
{
    /**
     * @throws InvalidSubversionDirectoryException
     */
    public function testGetGitamineCurrentDirectory(): void
    {
        $dir      = '/';
        $gitamine = GitamineMock::create();

        $gitamine->shouldGetProjectFolder($dir);

        $handler = new GetProjectDirectoryQueryHandler($gitamine->gitamine());
        self::assertEquals($dir, $handler(new GetProjectDirectoryQuery()));
    }
}
