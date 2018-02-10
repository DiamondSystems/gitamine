<?php

declare(strict_types=1);

namespace Gitamine\Git\PreCommit\Infrastructure;

use Gitamine\Git\Common\Domain\File;
use Gitamine\Git\Common\Domain\FileStatus;

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
