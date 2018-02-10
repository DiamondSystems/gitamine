<?php

declare(strict_types=1);

namespace App\Command;

use App\Prooph\QueryBus;
use Gitamine\Deprecated\Core\Command\RunPluginCommand;
use Gitamine\Deprecated\Core\Exception\InvalidSubversionDirectoryException;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RunCommand.
 */
class TestCommand extends ContainerAwareCommand
{
    /**
     * @var QueryBus
     */
    private $bus;

    protected function configure(): void
    {
        $this
            ->setName('test')
            ->setDescription('run')
            ->setHelp('TODO remove');
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

        try {
            $this->bus->dispatch(new RunPluginCommand('phpunit'));
        } catch (InvalidSubversionDirectoryException $e) {
            return 1;
        }

        return 0;
    }
}
