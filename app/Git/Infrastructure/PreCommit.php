<?php

declare(strict_types=1);

namespace Gitamine\Git\Infrastructure;

use Gitamine\Git\Domain\File;
use Gitamine\Git\Domain\FileStatus;

/**
 * Interface PreCommit.
 */
interface PreCommit
{
    /**
     * @param FileStatus $status
     *
     * @return File[]
     */
    public function getFiles(FileStatus $status): array;

    /**
     * @param FileStatus $status
     *
     * @return File[]
     */
    public function getStagedFiles(FileStatus $status): array;

    /**
     * @param FileStatus $status
     *
     * @return File[]
     */
    public function getNotStagedFiles(FileStatus $status): array;
}
