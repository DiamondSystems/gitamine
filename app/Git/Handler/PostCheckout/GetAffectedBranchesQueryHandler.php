<?php

declare(strict_types=1);

namespace Gitamine\Git\Handler\PostCheckout;

use Gitamine\Git\Infrastructure\PostCheckout;
use Gitamine\Git\Query\PostCheckout\GetAffectedBranchesQuery;

/**
 * Class GetAffectedBranchesQueryHandler.
 */
final class GetAffectedBranchesQueryHandler
{
    /**
     * @var PostCheckout
     */
    private $postCheckout;

    /**
     * GetAffectedBranchesQueryHandler constructor.
     *
     * @param PostCheckout $postCheckout
     */
    public function __construct(PostCheckout $postCheckout)
    {
        $this->postCheckout = $postCheckout;
    }
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @param GetAffectedBranchesQuery $query
     *
     * @return array
     */
    public function __invoke(GetAffectedBranchesQuery $query): array
    {
        [$source, $destiny] = $this->postCheckout->getAffectedBranches();

        return [
            $source->name(),
            $destiny->name()
        ];
    }
}
