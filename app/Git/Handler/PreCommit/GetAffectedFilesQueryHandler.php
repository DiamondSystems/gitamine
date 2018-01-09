<?php

declare(strict_types=1);

namespace Gitamine\Git\Handler\PreCommit;

use Gitamine\Git\Domain\File;
use Gitamine\Git\Domain\FileStatus;
use Gitamine\Git\Infrastructure\PreCommit;
use Gitamine\Git\Query\PreCommit\GetAffectedFilesQuery;

/**
 * Class GetAffectedFilesQueryHandler.
 */
final class GetAffectedFilesQueryHandler
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
     * @param GetAffectedFilesQuery $query
     *
     * @return File[]
     */
    public function __invoke(GetAffectedFilesQuery $query): array
    {
        $files = $this->preCommit->getFiles(new FileStatus($query->status()));

        return \array_map(function (File $file) {
            return $file->file();
        }, $files);
    }
}
