<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Test;

use Gitamine\Deprecated\Core\Domain\Directory;
use Gitamine\Deprecated\Core\Domain\Event;
use Gitamine\Deprecated\Core\Domain\GithubPlugin;
use Gitamine\Deprecated\Core\Domain\GithubPluginName;
use Gitamine\Deprecated\Core\Domain\GithubPluginVersion;
use Gitamine\Deprecated\Core\Domain\Plugin;
use Gitamine\Deprecated\Core\Domain\PluginOptions;
use Gitamine\Deprecated\Core\Domain\Verbose;
use Gitamine\Deprecated\Core\Infrastructure\GitamineConfig;
use Hamcrest\Matchers;
use Mockery;
use Mockery\MockInterface;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 *
 * Class GitamineMock
 */
class GitamineMock
{
    /**
     * @var MockInterface
     */
    private $gitamine;

    public function __construct()
    {
        $this->gitamine = Mockery::mock(GitamineConfig::class);
    }

    /**
     * @return self
     */
    public static function create(): self
    {
        return new self();
    }

    /**
     * @return GitamineConfig
     */
    public function gitamine(): GitamineConfig
    {
        return $this->gitamine;
    }

    /**
     * @param string $plugin
     * @param string $event
     * @param array  $options
     */
    public function shouldGetOptionsForPlugin(string $plugin, string $event, array $options = []): void
    {
        $thePlugin    = Matchers::equalTo(new Plugin($plugin));
        $theEvent     = Matchers::equalTo(new Event($event));
        $theDirectory = Matchers::anInstanceOf(Directory::class);
        $this->gitamine->shouldReceive('getOptionsForPlugin')
                       ->once()
                       ->with($theDirectory, $thePlugin, $theEvent)
                       ->andReturn(new PluginOptions($options));
    }

    /**
     * @param string $plugin
     * @param string $event
     * @param int    $verbose
     * @param bool   $return
     */
    public function shouldRunPlugin(string $plugin, string $event, int $verbose, bool $return): void
    {
        $thePlugin = Matchers::equalTo(new GithubPlugin(
            new GithubPluginName($plugin),
            new GithubPluginVersion('master')
        ));
        $theEvent   = Matchers::equalTo(new Event($event));
        $theOptions = Matchers::anInstanceOf(PluginOptions::class);
        $theLevel   = Matchers::equalTo(new Verbose($verbose));

        $this->gitamine->shouldReceive('runPlugin')
                       ->once()
                       ->with($thePlugin, $theEvent, $theOptions, '', $theLevel, '')
                       ->andReturn($return);
    }

    /**
     * @param string   $dir
     * @param string   $event
     * @param string[] $return
     */
    public function shouldGetPluginList(string $dir, string $event, array $return): void
    {
        $plugins = [];
        foreach ($return as $plugin) {
            $plugins[] = new Plugin($plugin);
        }

        $this->gitamine->shouldReceive('getPluginList')
                       ->once()
                       ->with(Matchers::equalTo(new Directory($dir)), Matchers::equalTo(new Event($event)))
                       ->andReturn($plugins);
    }

    /**
     * @param string $dir
     * @param array  $return
     */
    public function shouldGetConfiguration(string $dir, array $return): void
    {
        $this->gitamine->shouldReceive('getConfiguration')
                       ->once()
                       ->with(Matchers::equalTo(new Directory($dir)))
                       ->andReturn($return);
    }

    /**
     * @param string $return
     */
    public function shouldGetGitamineFolder(string $return): void
    {
        $this->gitamine->shouldReceive('getGitamineFolder')
                       ->once()
                       ->with()
                       ->andReturn(new Directory($return));
    }

    /**
     * @param string $return
     */
    public function shouldGetProjectFolder(string $return): void
    {
        $this->gitamine->shouldReceive('getProjectFolder')
                       ->once()
                       ->with()
                       ->andReturn(new Directory($return));
    }

    /**
     * @param string $name
     * @param string $version
     * @param string $return
     */
    public function shouldInstallGithubPlugin(string $name, string $version, string $return = ''): void
    {
        $thePlugin = Matchers::equalTo(new GithubPlugin(
            new GithubPluginName($name),
            new GithubPluginVersion($version)
        ));
        $this->gitamine->shouldReceive('installGithubPlugin')
                       ->once()
                       ->with($thePlugin)
                       ->andReturn($return);
    }

    /**
     * @param string $plugin
     * @param string $returnName
     * @param string $returnVersion
     */
    public function shouldGetGithubPluginForPlugin(string $plugin, string $returnName, string $returnVersion): void
    {
        $return = new GithubPlugin(
            new GithubPluginName($returnName),
            new GithubPluginVersion($returnVersion)
        );
        $this->gitamine->shouldReceive('getGithubPluginForPlugin')
                       ->once()
                       ->with(Matchers::equalTo(new Plugin($plugin)))
                       ->andReturn($return);
    }

    /**
     * @param string $plugin
     * @param string $version
     * @param bool   $return
     */
    public function shouldPluginBeInstalled(string $plugin, string $version, bool $return): void
    {
        $thePlugin = Matchers::equalTo(new GithubPlugin(
            new GithubPluginName($plugin),
            new GithubPluginVersion($version)
        ));
        $this->gitamine->shouldReceive('isPluginInstalled')
                       ->once()
                       ->with($thePlugin)
                       ->andReturn($return);
    }
}
