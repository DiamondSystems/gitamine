<?php

declare(strict_types=1);

namespace App\Command\Git\PostCheckout;

use App\Prooph\SynchronousQueryBus;
use Gitamine\Exception\InvalidSubversionDirectoryException;
use Gitamine\Git\Query\PostCheckout\GetAffectedFilesQuery;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GetAffectedFilesCommand.
 */
final class GetAffectedFilesCommand extends ContainerAwareCommand
{
    /**
     * @var SynchronousQueryBus;
     */
    private $bus;

    protected function configure(): void
    {
        $this
            ->setName('git:post-checkout:files')
            ->setDescription('Returns a list of files that have differied from the given branch')
            ->addArgument(
                'source-branch',
                InputArgument::OPTIONAL,
                'Reference branch'
            )
            ->addArgument('join', InputArgument::OPTIONAL, 'How to join the files', "\n")
            ->addArgument('filter', InputArgument::OPTIONAL, 'Reference branch', '.*');
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
        $branch    = $input->getArgument('source-branch');
        $filter    = $input->getArgument('filter');
        $status    = $input->getArgument('status');
        $join      = $input->getArgument('join');

        try {
            /** @var string[] $files */
            $files = $this->bus->dispatch(new GetAffectedFilesQuery($branch, $status, $filter));

            $output->writeln(implode($join, $files));
        } catch (InvalidSubversionDirectoryException $e) {
            $output->writeln("<error>{$e->getMessage()}</error>");

            return $e->getCode();
        }

        return 0;
    }
}
