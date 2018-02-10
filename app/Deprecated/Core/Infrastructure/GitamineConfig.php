<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Infrastructure;

use Gitamine\Deprecated\Core\Domain\Directory;
use Gitamine\Deprecated\Core\Domain\Event;
use Gitamine\Deprecated\Core\Domain\File;
use Gitamine\Deprecated\Core\Domain\GithubPlugin;
use Gitamine\Deprecated\Core\Domain\Plugin;
use Gitamine\Deprecated\Core\Domain\PluginOptions;
use Gitamine\Deprecated\Core\Domain\Verbose;

/**
 * Interface GitamineConfig.
 */
interface GitamineConfig
{
    /**
     * @param Directory $directory
     *
     * @return File
     */
    public function getConfigurationFile(Directory $directory): File;

    /**
     * @param Directory $directory
     *
     * @return array
     */
    public function getConfiguration(Directory $directory): array;

    /**
     * @param GithubPlugin  $githubPlugin
     * @param Event         $event
     * @param PluginOptions $pluginOptions
     * @param string        $params
     * @param Verbose       $verbose
     * @param null|string   $output
     *
     * @return bool
     */
    public function runPlugin(
        GithubPlugin $githubPlugin,
        Event $event,
        PluginOptions $pluginOptions,
        string $params,
        Verbose $verbose,
        ?string &$output
    ): bool;

    /**
     * @param Directory $directory
     * @param Event     $event
     *
     * @return Plugin[]
     */
    public function getPluginList(Directory $directory, Event $event): array;

    /**
     * @param Directory $directory
     * @param Plugin    $plugin
     * @param Event     $event
     *
     * @return PluginOptions
     */
    public function getOptionsForPlugin(Directory $directory, Plugin $plugin, Event $event): PluginOptions;

    /**
     * @return Directory
     */
    public function getGitamineFolder(): Directory;

    /**
     * @return array
     */
    public function getGitaminePlugins(): array;

    /**
     * @param GithubPlugin $gPlugin
     *
     * @return File
     */
    public function getPluginExecutableFile(GithubPlugin $gPlugin): File;

    /**
     * return the Directory which the project is located.
     *
     * @return Directory
     */
    public function getProjectFolder(): Directory;

    /**
     * @param GithubPlugin $plugin
     *
     * @return string
     */
    public function installGithubPlugin(GithubPlugin $plugin): string;

    /**
     * @param Plugin $plugin
     *
     * @return GithubPlugin
     */
    public function getGithubPluginForPlugin(Plugin $plugin): GithubPlugin;

    /**
     * @param GithubPlugin $plugin
     *
     * @return bool
     */
    public function isPluginInstalled(GithubPlugin $plugin): bool;
}
