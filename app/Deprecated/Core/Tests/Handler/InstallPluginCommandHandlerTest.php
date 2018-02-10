<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Tests\Handler;

use Gitamine\Deprecated\Core\Command\InstallPluginCommand;
use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Deprecated\Core\Command\Handler\InstallPluginCommandHandler;
use Gitamine\Deprecated\Core\Test\GitamineMock;
use Gitamine\Deprecated\Core\Test\OutputMock;

/**
 * Class RunPluginCommandHandlerTest.
 *
 * @coversNothing
 */
class InstallPluginCommandHandlerTest extends TestCase
{
    public function testShouldInstallPlugin(): void
    {
        $gitamine = GitamineMock::create();
        $output   = OutputMock::create();

        $gitamine->shouldInstallGithubPlugin('test/test', 'master');

        $handler = new InstallPluginCommandHandler($gitamine->gitamine(), $output->output());
        $handler(new InstallPluginCommand('test/test', 'master'));
    }
}
