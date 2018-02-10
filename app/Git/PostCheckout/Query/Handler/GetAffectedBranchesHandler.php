<?php

declare(strict_types=1);

namespace Gitamine\Git\PostCheckout\Query\Handler;

use Gitamine\Git\PostCheckout\Infrastructure\PostCheckout;
use Gitamine\Git\PostCheckout\Query\GetAffectedBranches;

/**
 * Class GetAffectedBranchesHandler
 */
final class GetAffectedBranchesHandler
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
     * @param GetAffectedBranches $query
     *
     * @return array
     */
    public function __invoke(GetAffectedBranches $query): array
    {
        $branches = $this->postCheckout->getAffectedBranches();

        if (count($branches) === 2) {
            [$source, $destiny] = $branches;

            return [
                $source->name(),
                $destiny->name()
            ];
        }

        return [];
    }
}
