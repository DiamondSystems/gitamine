<?php

declare(strict_types=1);

namespace App\Command\Git\Branch;

use App\Prooph\QueryBus;
use Gitamine\Core\Exception\InfrastructureException;
use Gitamine\Deprecated\Core\Exception\InvalidSubversionDirectoryException;
use Gitamine\Git\Branch\Query\GetBranch;
use Gitamine\Git\PostCheckout\Query\GetAffectedBranches;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GetCurrentBranch.
 */
final class GetCurrentBranch extends ContainerAwareCommand
{
    /**
     * @var QueryBus;
     */
    private $bus;

    /**
     * GetAffectedBranchesCommand constructor.
     *
     * @param QueryBus $bus
     */
    public function __construct(QueryBus $bus)
    {
        parent::__construct();

        $this->bus = $bus;
    }

    protected function configure(): void
    {
        $this
            ->setName('git:branch:current')
            ->setDescription('Returns the current brnach name');
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
        $branch = $this->bus->dispatch(new GetBranch());
        try {
            $output->writeln($branch);
        } catch (InfrastructureException $e) {
            $output->writeln("<error>{$e->getMessage()}</error>");
        }

        return 0;
    }
}
