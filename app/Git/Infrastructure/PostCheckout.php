<?php

declare(strict_types=1);

namespace Gitamine\Git\Infrastructure;

use Generator;
use Gitamine\Git\Domain\Branch;
use Gitamine\Git\Domain\File;

/**
 * Interface PostCheckout.
 */
interface PostCheckout
{
    /**
     * @return Branch[]
     */
    public function getAffectedBranches(): array;

    /**
     * @param Branch $source
     * @param Branch $destiny
     *
     * @return File[]|Generator
     */
    public function getAffectedFiles(Branch $source = null, Branch $destiny): Generator;
}
