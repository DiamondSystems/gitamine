<?php

declare(strict_types=1);

namespace Gitamine\Git\Handler\PostCheckout;

use Gitamine\Git\Infrastructure\PostCheckout;

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
     * @return array
     */
    public function __invoke(): array
    {
        [$source, $destiny] = $this->postCheckout->getAffectedBranches();

        return [
            $source->name(),
            $destiny->name()
        ];
    }
}
