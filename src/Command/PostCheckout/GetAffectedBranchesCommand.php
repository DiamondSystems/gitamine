<?php

declare(strict_types=1);

namespace App\Command\PostCheckout;

use App\Prooph\SynchronousQueryBus;
use Gitamine\Exception\InvalidSubversionDirectoryException;
use Gitamine\Git\Query\PostCheckout\GetAffectedBranchesQuery;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
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
            ->setName('git:post-checkout:branches')
            ->setDescription('Returns the source and destiny branches on a post-checkout');
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
            /* @var string[] $files */
            [$source, $destination] = $this->bus->dispatch(new GetAffectedBranchesQuery());

            $output->writeln("{$source},{$destination}");
        } catch (InvalidSubversionDirectoryException $e) {
            $output->writeln("<error>{$e->getMessage()}</error>");

            return $e->getCode();
        }

        return 0;
    }
}
