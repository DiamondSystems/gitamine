<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Tests\Handler;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Deprecated\Core\Query\Handler\GetGitamineDirectoryQueryHandler;
use Gitamine\Deprecated\Core\Query\GetGitamineDirectoryQuery;
use Gitamine\Deprecated\Core\Test\GitamineMock;

/**
 * Class GetGitamineDirectoryQueryHandlerTest.
 *
 * @coversNothing
 */
class GetGitamineDirectoryQueryHandlerTest extends TestCase
{
    /**
     * @throws InvalidSubversionDirectoryException
     */
    public function testGetGitamineDirectory(): void
    {
        $dir      = '/';
        $gitamine = GitamineMock::create();

        $gitamine->shouldGetGitamineFolder($dir);

        $handler = new GetGitamineDirectoryQueryHandler($gitamine->gitamine());
        self::assertEquals($dir, $handler(new GetGitamineDirectoryQuery()));
    }
}
