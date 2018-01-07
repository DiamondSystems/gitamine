<?php
declare(strict_types=1);

namespace Gitamine\Infrastructure\Git;

use Gitamine\Git\Domain\Branch;
use Gitamine\Git\Infrastructure\Git as BaseGit;

/**
 * Class Git
 *
 * @package Gitamine\Infrastructure\Git
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
