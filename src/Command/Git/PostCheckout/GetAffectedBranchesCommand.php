<?php

declare(strict_types=1);

namespace App\Command\Git\PostCheckout;

use App\Prooph\QueryBus;
use Gitamine\Deprecated\Core\Exception\InvalidSubversionDirectoryException;
use Gitamine\Git\PostCheckout\Query\GetAffectedBranches;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GetAffectedBranchesCommand.
 */
final class GetAffectedBranchesCommand extends ContainerAwareCommand
{
    /**
     * @var QueryBus;
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
            $branches = $this->bus->dispatch(new GetAffectedBranches());

            if (count($branches) === 2) {
                [$source, $destination] = $branches;
                $output->writeln("{$source},{$destination}");
            } else {
                $output->writeln('<error>No branches are affected</error>');
            }
        } catch (InvalidSubversionDirectoryException $e) {
            $output->writeln("<error>{$e->getMessage()}</error>");

            return $e->getCode();
        }

        return 0;
    }
}
