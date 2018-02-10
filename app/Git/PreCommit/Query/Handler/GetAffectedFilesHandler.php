<?php

declare(strict_types=1);

namespace Gitamine\Git\PreCommit\Query\Handler;

use Gitamine\Git\Common\Domain\File;
use Gitamine\Git\Common\Domain\FileStatus;
use Gitamine\Git\PreCommit\Infrastructure\PreCommit;
use Gitamine\Git\PreCommit\Query\GetAffectedFiles;

/**
 * Class GetAffectedFilesHandler
 */
final class GetAffectedFilesHandler
{
    /**
     * @var PreCommit
     */
    private $preCommit;

    /**
     * GetAffectedFilesQueryHandler constructor.
     *
     * @param PreCommit $preCommit
     */
    public function __construct(PreCommit $preCommit)
    {
        $this->preCommit = $preCommit;
    }

    /**
     * @param GetAffectedFiles $query
     *
     * @return File[]
     */
    public function __invoke(GetAffectedFiles $query): array
    {
        $files = $this->preCommit->getStagedFiles(new FileStatus($query->status()));

        return \array_map(function (File $file) {
            return $file->file();
        }, $files);
    }
}
