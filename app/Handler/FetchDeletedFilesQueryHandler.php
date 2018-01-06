<?php

declare(strict_types=1);

namespace Gitamine\Handler;

use Gitamine\Domain\Directory;
use Gitamine\Exception\InvalidSubversionDirectoryException;
use Gitamine\Infrastructure\SubversionRepository;
use Gitamine\Query\FetchDeletedFilesQuery;

/**
 * Class FetchDeletedFilesQueryHandler.
 */
class FetchDeletedFilesQueryHandler
{
    /**
     * @var SubversionRepository
     */
    private $repository;

    /**
     * FetchCommittedFilesQueryHandler constructor.
     *
     * @param SubversionRepository $repository
     */
    public function __construct(SubversionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param FetchDeletedFilesQuery $query
     *
     * @throws InvalidSubversionDirectoryException
     *
     * @return array
     */
    public function __invoke(FetchDeletedFilesQuery $query): array
    {
        $dir = new Directory($query->dir());

        if (!$this->repository->isValidSubversionFolder($dir)) {
            throw new InvalidSubversionDirectoryException($dir);
        }

        return $this->repository->getDeletedFiles($dir);
    }
}
