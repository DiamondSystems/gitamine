<?php

declare(strict_types=1);

namespace Gitamine\Git\PostCheckout\Infrastructure;

use Gitamine\Git\Common\Domain\Branch;
use Gitamine\Git\Common\Domain\File;
use Gitamine\Git\Common\Domain\FileStatus;

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
