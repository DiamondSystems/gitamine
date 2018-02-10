<?php

declare(strict_types=1);

namespace App\Command;

use App\Prooph\QueryBus;
use Gitamine\Deprecated\Core\Domain\Event;
use Gitamine\Deprecated\Core\Query\GetProjectDirectoryQuery;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class InstallPluginCommand.
 */
class InitCommand extends ContainerAwareCommand
{
    /**
     * @var QueryBus;
     */
    private $bus;

    protected function configure(): void
    {
        $this
            ->setName('init')
            ->setDescription('TODO')
            ->setHelp('TODO');
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->bus = $this->getContainer()->get('prooph_service_bus.gitamine_query_bus');
        $dir       = $this->bus->dispatch(new GetProjectDirectoryQuery());

        \exec('mkdir ~/.gitamine 2> /dev/null');
        \exec('mkdir ~/.gitamine/plugins 2> /dev/null');

        $bin = \dirname(__DIR__, 2) . '/gitamine';

        // TODO Initialize project hooks or update
        foreach (Event::VALID_EVENTS as $event) {
            $command = 'eval ' . $bin . ' run ' . $event . ' \\\\\"\\$*\\\\\"';
            \system("echo $command > {$dir}/.git/hooks/{$event}");
            \system("chmod +x {$dir}/.git/hooks/{$event}");
        }

        return 0;
    }
}
