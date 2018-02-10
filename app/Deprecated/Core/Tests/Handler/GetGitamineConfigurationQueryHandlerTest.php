<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Tests\Handler;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Deprecated\Core\Exception\InvalidSubversionDirectoryException;
use Gitamine\Deprecated\Core\Query\Handler\GetGitamineConfigurationQueryHandler;
use Gitamine\Deprecated\Core\Query\GetGitamineConfigurationQuery;
use Gitamine\Deprecated\Core\Test\GitamineMock;
use Gitamine\Deprecated\Core\Test\VersionControlMock;

/**
 * Class GetConfiguratedPluginsQueryHandlerTest.
 *
 * @coversNothing
 */
class GetGitamineConfigurationQueryHandlerTest extends TestCase
{
    /**
     * @throws InvalidSubversionDirectoryException
     */
    public function testGetConfiguratedPlugins(): void
    {
        $dir      = '/';
        $git      = VersionControlMock::create();
        $gitamine = GitamineMock::create();

        $git->shouldBeValidVersionControlFolder($dir, true);
        $git->shouldGetRootDir($dir, $dir);

        $gitamine->shouldGetConfiguration($dir, []);

        $handler = new GetGitamineConfigurationQueryHandler($git->versionControl(), $gitamine->gitamine());

        self::assertEquals([], $handler(new GetGitamineConfigurationQuery($dir)));
    }

    /**
     * @throws InvalidSubversionDirectoryException
     */
    public function testShouldThrowInvalidSubversionDirectoryException(): void
    {
        $this->expectException(InvalidSubversionDirectoryException::class);

        $dir      = '/';
        $git      = VersionControlMock::create();
        $gitamine = GitamineMock::create();

        $git->shouldBeValidVersionControlFolder($dir, false);

        $handler = new GetGitamineConfigurationQueryHandler($git->versionControl(), $gitamine->gitamine());
        $handler(new GetGitamineConfigurationQuery($dir));
    }
}
