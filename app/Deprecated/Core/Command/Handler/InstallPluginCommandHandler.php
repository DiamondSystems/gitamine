<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Command\Handler;

use Gitamine\Deprecated\Core\Command\InstallPluginCommand;
use Gitamine\Deprecated\Core\Domain\GithubPlugin;
use Gitamine\Deprecated\Core\Domain\GithubPluginName;
use Gitamine\Deprecated\Core\Domain\GithubPluginVersion;
use Gitamine\Deprecated\Core\Infrastructure\GitamineConfig;
use Gitamine\Deprecated\Core\Infrastructure\Output;

/**
 * Class InstallPluginCommandHandler.
 */
class InstallPluginCommandHandler
{
    /**
     * @var GitamineConfig
     */
    private $gitamine;

    /**
     * @var Output
     */
    private $output;

    /**
     * InstallPluginCommandHandler constructor.
     *
     * @param GitamineConfig $gitamine
     * @param Output         $output
     */
    public function __construct(GitamineConfig $gitamine, Output $output)
    {
        $this->gitamine = $gitamine;
        $this->output   = $output;
    }

    /**
     * @param InstallPluginCommand $command
     */
    public function __invoke(InstallPluginCommand $command): void
    {
        $plugin = new GithubPlugin(
            new GithubPluginName($command->name()),
            new GithubPluginVersion($command->version())
        );

        $this->gitamine->installGithubPlugin($plugin);
    }
}
