<?php

declare(strict_types=1);

namespace Gitamine\Git\Branch\Query\Handler;

use Gitamine\Git\Branch\Infrastructure\Branch;
use Gitamine\Git\Branch\Query\GetBranch;

/**
 * Class GetBranchHandler.
 */
class GetBranchHandler
{
    /**
     * @var Branch
     */
    private $branch;

    /**
     * GetBranchHandler constructor.
     *
     * @param Branch $branch
     */
    public function __construct(Branch $branch)
    {
        $this->branch = $branch;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @param GetBranch $query
     *
     * @return string
     */
    public function __invoke(GetBranch $query): string
    {
        return $this->branch->getCurrentBranch()->name();
    }
}
