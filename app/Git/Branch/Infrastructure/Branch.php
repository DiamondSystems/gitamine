<?php

declare(strict_types=1);

namespace Gitamine\Git\Branch\Infrastructure;

use Gitamine\Git\Common\Domain\Branch as BranchDomain;

/**
 * Interface Branch.
 */
interface Branch
{
    /**
     * @return BranchDomain
     */
    public function getCurrentBranch(): BranchDomain;
}
