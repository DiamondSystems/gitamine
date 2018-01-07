<?php

declare(strict_types=1);

namespace Gitamine\Tests\Handler;

use Gitamine\Common\Test\TestCase;
use Gitamine\Handler\GetGitamineDirectoryQueryHandler;
use Gitamine\Query\GetGitamineDirectoryQuery;
use Gitamine\Test\GitamineMock;

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
