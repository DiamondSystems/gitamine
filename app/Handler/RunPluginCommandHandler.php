<?php

declare(strict_types=1);

namespace Gitamine\Handler;

use App\Prooph\SynchronousQueryBus;
use Gitamine\Command\InstallPluginCommand;
use Gitamine\Command\RunPluginCommand;
use Gitamine\Domain\Directory;
use Gitamine\Domain\Event;
use Gitamine\Domain\GithubPlugin;
use Gitamine\Domain\Plugin;
use Gitamine\Exception\PluginExecutionFailedException;
use Gitamine\Infrastructure\GitamineConfig;
use Gitamine\Infrastructure\Output;
use Gitamine\Query\GetProjectDirectoryQuery;

/**
 * Class RunPluginCommandHandler.
 */
class RunPluginCommandHandler
{
    /**
     * @var SynchronousQueryBus
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
     * @param SynchronousQueryBus $bus
     * @param GitamineConfig      $gitamine
     * @param Output              $output
     */
    public function __construct(SynchronousQueryBus $bus, GitamineConfig $gitamine, Output $output)
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
            $this->output->print(\str_pad("<info>Running</info> {$plugin->name()}:", 36));

            $success = $this->gitamine->runPlugin($githubPlugin, $event, $options, $result);

            if (!$success) {
                $this->output->println("\t<fail>✘</fail>");
                $this->output->println($result);

                throw new PluginExecutionFailedException('Failed', 2);
            }

            $this->output->println("\t<success>✔</success>");
        }
    }
}
