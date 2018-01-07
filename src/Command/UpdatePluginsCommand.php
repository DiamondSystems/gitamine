<?php

declare(strict_types=1);

namespace App\Command;

use App\Prooph\SynchronousQueryBus;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class InstallPluginCommand.
 */
class UpdatePluginsCommand extends ContainerAwareCommand
{
    /**
     * @var SynchronousQueryBus;
     */
    private $bus;

    protected function configure(): void
    {
        $this
            ->setName('update')
            ->setDescription('update plugins')
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
        \exec('
                cd ~/.gitamine/plugins/git4min3 ; 
                find . -type d -depth 1 -exec git --git-dir={}/.git --work-tree=$PWD/{} pull origin master \;
            ');
        $this->bus = $this->getContainer()->get('prooph_service_bus.gitamine_query_bus');

        return 1;
    }
}
