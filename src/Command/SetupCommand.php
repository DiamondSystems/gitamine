<?php
declare(strict_types=1);

namespace App\Command;

use App\Prooph\SynchronousQueryBus;
use Gitamine\Domain\Event;
use Gitamine\Query\GetProjectDirectoryQuery;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SetupCommand
 *
 * @package App\Command
 */
class SetupCommand extends ContainerAwareCommand
{
    /**
     * @var SynchronousQueryBus;
     */
    private $bus;

    protected function configure(): void
    {
        $this
            ->setName('setup')
            ->setDescription('TODO')
            ->setHelp('TODO');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->bus = $this->getContainer()->get('prooph_service_bus.gitamine_query_bus');
        $dir = $this->bus->dispatch(new GetProjectDirectoryQuery());


        system('mkdir ~/.gitamine 2> /dev/null');
        system('mkdir ~/.gitamine/plugins 2> /dev/null');
        system('rm -Rf ~/.gitamine 2> /dev/null');
        system("cp -R $dir/public/gitamine ~/.gitamine 2> /dev/null");

        $this->bus = $this->getContainer()->get('prooph_service_bus.gitamine_query_bus');

        return 0;
    }

    /**
     * @param string $plugin
     * @param string $type
     * @param string $code
     */
    private function createPlugin(string $plugin, string $type, string $code)
    {
        system("mkdir ~/.gitamine/plugins/$plugin 2> /dev/null");
        system("echo '#!/usr/bin/env $type' > ~/.gitamine/plugins/$plugin/run");
        system("echo '$code' >> ~/.gitamine/plugins/$plugin/run");
        system("chmod +x ~/.gitamine/plugins/$plugin/run");
        system("chmod 755 ~/.gitamine/plugins/$plugin/run");
    }
}
