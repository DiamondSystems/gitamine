<?php
declare(strict_types=1);

namespace App\GitamineConfig;

use Gitamine\Domain\Directory;
use Gitamine\Domain\Event;
use Gitamine\Domain\File;
use Gitamine\Domain\GithubPlugin;
use Gitamine\Domain\GithubPluginName;
use Gitamine\Domain\GithubPluginVersion;
use Gitamine\Domain\Plugin;
use Gitamine\Domain\PluginOptions;
use Gitamine\Exception\GithubProjectDoesNotExist;
use Gitamine\Exception\InvalidDirException;
use Gitamine\Exception\MissingConfigurationFileException;
use Gitamine\Infrastructure\GitamineConfig;

/**
 * TODO
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 *
 * Class YamlGitamineConfig
 *
 * @package App\GitamineConfig
 */
class YamlGitamineConfig implements GitamineConfig
{
    private const GITAMINE_FILE = 'gitamine.yaml';

    /**
     * @var array
     */
    private $config;

    /**
     * @param Directory $directory
     *
     * @return File
     */
    public function getConfigurationFile(Directory $directory): File
    {
        return $directory->open(self::GITAMINE_FILE);
    }

    /**
     * @param Directory $directory
     *
     * @return array
     */
    public function getConfiguration(Directory $directory): array
    {
        if (!$this->config) {
            $config = \Symfony\Component\Yaml\Yaml::parseFile($this->getConfigurationFile($directory)->file());

            $this->config              = $config['gitamine'];
            $this->config['_requires'] = $this->config['_requires'] ?? [];
            foreach (Event::VALID_EVENTS as $event) {
                $this->config[$event] = $this->config[$event] ?? [];
            }
        }

        return $this->config;
    }

    /**
     * @param Plugin        $plugin
     * @param Event         $event
     * @param PluginOptions $pluginOptions
     * @param null|string   $output
     *
     * @return bool
     */
    public function runPlugin(Plugin $plugin, Event $event, PluginOptions $pluginOptions, ?string &$output = null): bool
    {
        $status = 0;
        $out    = [];

        $params = ' --event=' . $event->event();

        foreach ($pluginOptions->options() as $key => $value) {
            $params .= sprintf(' --%s=%s', $key, $value);
        }

        // passthru
        exec($this->getPluginExecutableFile($plugin)->file() . $params . ' 2>&1', $out, $status);
        $output = implode("\n", $out);

        return $status === 0;
    }

    /**
     * @param Directory $directory
     * @param Event     $event
     *
     * @return Plugin[]
     */
    public function getPluginList(Directory $directory, Event $event): array
    {
        $config            = $this->getConfiguration($directory);
        $config['plugins'] = $config[$event->event()] ?? [];

        $plugins = [];

        foreach (array_keys($config['plugins']) as $plugin) {
            $plugins[] = new Plugin($plugin);
        }

        return $plugins;
    }

    /**
     * @param Directory $directory
     * @param Plugin    $plugin
     * @param Event     $event
     *
     * @return PluginOptions
     */
    public function getOptionsForPlugin(Directory $directory, Plugin $plugin, Event $event): PluginOptions
    {
        $config                  = $this->getConfiguration($directory);
        $config[$event->event()] = $config[$event->event()] ?? [];

        return new PluginOptions($config[$event->event()][$plugin->name()] ?? []);
    }

    /**
     * @return Directory
     */
    public function getGitamineFolder(): Directory
    {
        return $this->getHomeFolder()->cd('.gitamine');
    }

    /**
     * @return Plugin[]
     */
    public function getGitaminePlugins(): array
    {
        $pluginsDir = $this->getGitamineFolder()->cd('plugins')->directories();
        $plugins    = [];

        foreach ($pluginsDir as $pluginDir) {
            $plugins[] = new Plugin($pluginDir->name());
        }

        return $plugins;
    }

    /**
     * @param Plugin $plugin
     *
     * @return File
     */
    public function getPluginExecutableFile(Plugin $plugin): File
    {
        return $this->getGitamineFolder()->cd('plugins')->cd($plugin->name())->open('run');
    }

    /**
     * @SuppressWarnings(PHPMD.Superglobals)
     *
     * @return Directory
     */
    private function getHomeFolder(): Directory
    {
        return new Directory($_SERVER['HOME']);
    }

    /**
     * @return Directory
     */
    public function getProjectFolder(): Directory
    {
        return new Directory(getcwd());
    }

    /**
     * @param GithubPlugin $plugin
     *
     * @return string
     *
     * @throws GithubProjectDoesNotExist
     * @throws MissingConfigurationFileException
     */
    public function installGithubPlugin(GithubPlugin $plugin): string
    {
        $curl = curl_init(
            sprintf(
                'https://raw.githubusercontent.com/%s/%s/gitamine.json',
                $plugin->name()->name(),
                $plugin->version()->version()
            )
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($httpCode !== 200) {
            //TODO add ... with version XXX
            throw new GithubProjectDoesNotExist($plugin->name()->name());
        }

        if (!$response) {
            throw new MissingConfigurationFileException();
        }

        $dir = $this->getGitamineFolder()->name();

        exec(
            sprintf(
                'rm -Rf ~/%s/plugins/%s > /dev/null',
                $dir,
                $plugin->name()->name()
            )
        );

        exec(
            sprintf(
                'git clone git@github.com:%s.git ~/%s/plugins/%s',
                $plugin->name()->name(),
                $dir,
                $plugin->name()->name()
            )
        );

        exec(
            sprintf(
                'cd %s/plugins/%s 2> /dev/null; git checkout %s 2> /dev/null',
                $dir,
                $plugin->name()->name(),
                $plugin->version()->version()
            )
        );

        // DO NOTHING BY NOW

        return '.---.';
    }

    /**
     * @param Plugin $plugin
     *
     * @return GithubPlugin
     */
    public function getGithubPluginForPlugin(Plugin $plugin): GithubPlugin
    {
        /** @var array $requirements */
        $requirements = $this->getConfiguration($this->getProjectFolder())['_requires'];

        foreach ($requirements as $requirement => $alias) {
            if ($alias === $plugin->name()) {
                return new GithubPlugin(
                    new GithubPluginName($requirement),
                    new GithubPluginVersion('master')
                );
            }
        }

        throw new \RuntimeException('Plugin is not listed as alias on _requires.');
    }

    /**
     * @param GithubPlugin $plugin
     *
     * @return bool
     */
    public function isPluginInstalled(GithubPlugin $plugin): bool
    {
        try {
            $this->getGitamineFolder()->cd('plugins')->cd($plugin->name()->name());
        } catch (InvalidDirException $e) {
            return false;
        }

        return true;
    }
}
