<?php

declare(strict_types=1);

namespace Gitamine\Git\Common\Infrastructure;

use Gitamine\Git\Common\Domain\Branch;

/**
 * Interface Git.
 */
interface Git
{
    /**
     * @return Branch
     */
    public function getCurrentBranch(): Branch;
}
