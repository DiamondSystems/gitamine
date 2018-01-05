<?php
declare(strict_types=1);

namespace Gitamine\Tests\Handler;

use Gitamine\Command\InstallPluginCommand;
use Gitamine\Command\RunPluginCommand;
use Gitamine\Common\Test\TestCase;
use Gitamine\Exception\PluginExecutionFailedException;
use Gitamine\Handler\RunPluginCommandHandler;
use Gitamine\Query\GetProjectDirectoryQuery;
use Gitamine\Test\GitamineMock;
use Gitamine\Test\OutputMock;
use Gitamine\Test\QueryBusMock;

/**
 * Class RunPluginCommandHandlerTest
 *
 * @package Gitamine\Tests\Handler
 */
class RunPluginCommandHandlerTest extends TestCase
{
    /**
     * @throws PluginExecutionFailedException
     */
    public function testShouldRunPlugin()
    {
        $dir = '/';

        $bus      = QueryBusMock::create();
        $gitamine = GitamineMock::create();
        $output   = OutputMock::create();

        $bus->shouldDispatch(new GetProjectDirectoryQuery(), $dir);

        $gitamine->shouldPluginBeInstalled('test/test', 'master', true);
        $gitamine->shouldGetGithubPluginForPlugin('test', 'test/test', 'master');
        $gitamine->shouldGetOptionsForPlugin('test', 'pre-commit');
        $gitamine->shouldRunPlugin('test', 'pre-commit', true);

        $handler = new RunPluginCommandHandler($bus->bus(), $gitamine->gitamine(), $output->output());
        $handler(new RunPluginCommand('test', 'pre-commit'));
    }

    /**
     * @throws PluginExecutionFailedException
     */
    public function testShouldThrowPluginExecutionFailedException()
    {
        $this->expectException(PluginExecutionFailedException::class);

        $dir = '/';

        $bus      = QueryBusMock::create();
        $gitamine = GitamineMock::create();
        $output   = OutputMock::create();

        $bus->shouldDispatch(new GetProjectDirectoryQuery(), $dir);

        $gitamine->shouldPluginBeInstalled('test/test', 'master', true);
        $gitamine->shouldGetGithubPluginForPlugin('test', 'test/test', 'master');
        $gitamine->shouldGetOptionsForPlugin('test', 'pre-commit');
        $gitamine->shouldRunPlugin('test', 'pre-commit', false);

        $handler = new RunPluginCommandHandler($bus->bus(), $gitamine->gitamine(), $output->output());
        $handler(new RunPluginCommand('test', 'pre-commit'));
    }

    /**
     * @throws PluginExecutionFailedException
     */
    public function testShouldInstallUninstalledPlugins()
    {
        $this->expectException(PluginExecutionFailedException::class);

        $dir = '/';

        $bus      = QueryBusMock::create();
        $gitamine = GitamineMock::create();
        $output   = OutputMock::create();

        $bus->shouldDispatch(new GetProjectDirectoryQuery(), $dir);

        $gitamine->shouldPluginBeInstalled('test/test', 'master', false);
        $gitamine->shouldGetGithubPluginForPlugin('test', 'test/test', 'master');
        $gitamine->shouldGetOptionsForPlugin('test', 'pre-commit');
        $gitamine->shouldRunPlugin('test', 'pre-commit', false);
        $bus->shouldDispatch(new InstallPluginCommand('test/test', 'master'), '');

        $handler = new RunPluginCommandHandler($bus->bus(), $gitamine->gitamine(), $output->output());
        $handler(new RunPluginCommand('test', 'pre-commit'));
    }
}
