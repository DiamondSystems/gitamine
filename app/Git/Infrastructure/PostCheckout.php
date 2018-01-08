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
     * @param bool   $added
     * @param bool   $modified
     * @param bool   $deleted
     *
     * @return File[]|Generator
     */
    public function getFiles(
        Branch $source,
        Branch $destiny,
        bool $added = true,
        bool $modified = true,
        bool $deleted = false
    ): Generator;
}
