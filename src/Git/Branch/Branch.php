<?php

declare(strict_types=1);

namespace App\Git\Branch;

use Gitamine\Core\Domain\Command;
use Gitamine\Git\Branch\Infrastructure\Branch as BaseBranch;
use Gitamine\Git\Common\Domain\Branch as BranchDomain;

/**
 * Class Branch.
 */
class Branch implements BaseBranch
{
    /**
     * @return BranchDomain
     */
    public function getCurrentBranch(): BranchDomain
    {
        $command = new Command('git branch 2> /dev/null | sed -e \'/^[^*]/d\' -e \'s/* \(.*\)/\1/\'');
        $command->run();

        $branch = $command->output();

        return new BranchDomain($branch);
    }
}
