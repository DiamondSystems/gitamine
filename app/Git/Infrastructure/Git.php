<?php
declare(strict_types=1);

namespace Gitamine\Git\Infrastructure;

use Gitamine\Git\Domain\Branch;

/**
 * Interface Git
 *
 * @package Gitamine\Git\Infrastructure
 */
interface Git
{
    /**
     * @return Branch
     */
    public function getCurrentBranch(): Branch;
}
