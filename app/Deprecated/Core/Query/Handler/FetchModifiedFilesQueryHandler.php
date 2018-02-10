<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Query\Handler;

use Gitamine\Deprecated\Core\Domain\Directory;
use Gitamine\Deprecated\Core\Exception\InvalidSubversionDirectoryException;
use Gitamine\Deprecated\Core\Infrastructure\SubversionRepository;
use Gitamine\Deprecated\Core\Query\FetchModifiedFilesQuery;

/**
 * Class FetchModifiedFilesQueryHandler.
 */
class FetchModifiedFilesQueryHandler
{
    /**
     * @var SubversionRepository
     */
    private $repository;

    /**
     * FetchCommitedFilesHandler constructor.
     *
     * @param SubversionRepository $repository
     */
    public function __construct(SubversionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param FetchModifiedFilesQuery $query
     *
     * @throws InvalidSubversionDirectoryException
     *
     * @return array
     */
    public function __invoke(FetchModifiedFilesQuery $query): array
    {
        $dir = new Directory($query->dir());

        if (!$this->repository->isValidSubversionFolder($dir)) {
            throw new InvalidSubversionDirectoryException($dir);
        }

        return $this->repository->getUpdatedFiles($dir);
    }
}
