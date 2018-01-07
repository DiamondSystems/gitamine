<?php

declare(strict_types=1);

namespace App\Command\PostCheckout;

use App\Prooph\SynchronousQueryBus;
use Gitamine\Exception\InvalidSubversionDirectoryException;
use Gitamine\Git\Query\PostCheckout\GetAffectedFilesQuery;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GetAffectedBranchesCommand.
 */
final class GetAffectedBranchesCommand extends ContainerAwareCommand
{
    /**
     * @var SynchronousQueryBus;
     */
    private $bus;

    protected function configure(): void
    {
        $this
            ->setName('post-commit:files')
            ->setDescription('Returns a list of files that have differied from the given branch')
            ->addArgument(
                'source-branch',
                InputArgument::OPTIONAL,
                'Reference branch'
            )
            ->addArgument(
                'filter',
                InputArgument::OPTIONAL,
                'Reference branch',
                '/*/'
            );
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

        try {
            /** @var string[] $files */
            $files = $this->bus->dispatch(new GetAffectedFilesQuery($branch, $filter));

            foreach ($files as $file) {
                $output->writeln($file);
            }
        } catch (InvalidSubversionDirectoryException $e) {
            $output->writeln("<error>{$e->getMessage()}</error>");

            return $e->getCode();
        }

        return 0;
    }
}
