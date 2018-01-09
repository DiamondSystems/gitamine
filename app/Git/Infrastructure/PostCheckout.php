<?php

declare(strict_types=1);

namespace Gitamine\Git\Infrastructure;

use Gitamine\Git\Domain\Branch;
use Gitamine\Git\Domain\File;
use Gitamine\Git\Domain\FileStatus;

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
     * @param Branch     $source
     * @param Branch     $destiny
     * @param FileStatus $status
     *
     * @return File[]
     */
    public function getFiles(Branch $source, Branch $destiny, FileStatus $status): array;
}
