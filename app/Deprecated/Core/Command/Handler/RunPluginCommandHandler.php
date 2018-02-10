<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Command\Handler;

use App\Prooph\QueryBus;
use Gitamine\Deprecated\Core\Command\InstallPluginCommand;
use Gitamine\Deprecated\Core\Command\RunPluginCommand;
use Gitamine\Deprecated\Core\Domain\Directory;
use Gitamine\Deprecated\Core\Domain\Event;
use Gitamine\Deprecated\Core\Domain\GithubPlugin;
use Gitamine\Deprecated\Core\Domain\Plugin;
use Gitamine\Deprecated\Core\Domain\Verbose;
use Gitamine\Deprecated\Core\Exception\PluginExecutionFailedException;
use Gitamine\Deprecated\Core\Infrastructure\GitamineConfig;
use Gitamine\Deprecated\Core\Infrastructure\Output;
use Gitamine\Deprecated\Core\Query\GetProjectDirectoryQuery;

/**
 * Class RunPluginCommandHandler.
 */
class RunPluginCommandHandler
{
    /**
     * @var QueryBus
     */
    private $bus;

    /**
     * @var GitamineConfig
     */
    private $gitamine;

    /**
     * @var Output
     */
    private $output;

    /**
     * RunPluginCommandHandler constructor.
     *
     * @param QueryBus       $bus
     * @param GitamineConfig $gitamine
     * @param Output         $output
     */
    public function __construct(QueryBus $bus, GitamineConfig $gitamine, Output $output)
    {
        $this->bus      = $bus;
        $this->gitamine = $gitamine;
        $this->output   = $output;
    }

    /**
     * @param RunPluginCommand $query
     *
     * @throws PluginExecutionFailedException
     */
    public function __invoke(RunPluginCommand $query): void
    {
        $dir    = new Directory($this->bus->dispatch(new GetProjectDirectoryQuery()));
        $plugin = new Plugin($query->plugin());
        $event  = new Event($query->event());
        $params = $query->params();

        $verbose = new Verbose(
            $this->gitamine->getConfiguration($this->gitamine->getProjectFolder())['_options']['verbose']
        );

        $options = $this->gitamine->getOptionsForPlugin($dir, $plugin, $event);
        $result  = '';

        if ($options->enabled()) {
            /** @var GithubPlugin $githubPlugin */
            $githubPlugin = $this->gitamine->getGithubPluginForPlugin($plugin);

            if (!$this->gitamine->isPluginInstalled($githubPlugin)) {
                $this->bus->dispatch(new InstallPluginCommand(
                    $githubPlugin->name()->name(),
                    $githubPlugin->version()->version()
                ));
            }

            // Running part
            if (Verbose::FULL === $verbose->level()) {
                $this->output->println(\str_pad("<info>Running</info> {$plugin->name()}:", 36));
            } else {
                $this->output->print(\str_pad("<info>Running</info> {$plugin->name()}:", 36));
            }

            $success = $this->gitamine->runPlugin($githubPlugin, $event, $options, $params, $verbose, $result);

            if (!$success) {
                if (Verbose::FULL === $verbose->level()) {
                    $this->output->print(\str_pad("<info>Running</info> {$plugin->name()}:", 36));
                    $this->output->println("\t<fail>✘</fail>");
                } elseif (Verbose::ONLY_ERRORS === $verbose->level()) {
                    $this->output->println("\t<fail>✘</fail>");
                    $this->output->println($result);
                } else {
                    $this->output->println("\t<fail>✘</fail>");
                }

                throw new PluginExecutionFailedException('Failed', 2);
            }

            if (Verbose::FULL === $verbose->level()) {
                $this->output->print(\str_pad("<info>Running</info> {$plugin->name()}:", 36));
                $this->output->println("\t<success>✔</success>");
            } elseif (Verbose::ONLY_ERRORS === $verbose->level()) {
                $this->output->println("\t<success>✔</success>");
            } else {
                $this->output->println("\t<success>✔</success>");
            }
        }
    }
}
