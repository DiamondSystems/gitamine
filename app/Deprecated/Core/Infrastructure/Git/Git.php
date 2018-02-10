<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Infrastructure\Git;

use Gitamine\Git\Common\Domain\Branch;
use Gitamine\Git\Infrastructure\Git as BaseGit;

/**
 * Class Git.
 */
class Git implements BaseGit
{
    /**
     * @return Branch
     */
    public function getCurrentBranch(): Branch
    {
        // TODO: Implement getCurrentBranch() method.
    }
}
