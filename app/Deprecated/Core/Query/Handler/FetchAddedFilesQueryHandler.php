<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Query\Handler;

use Gitamine\Deprecated\Core\Domain\Directory;
use Gitamine\Deprecated\Core\Exception\InvalidSubversionDirectoryException;
use Gitamine\Deprecated\Core\Infrastructure\SubversionRepository;
use Gitamine\Deprecated\Core\Query\FetchAddedFilesQuery;

/**
 * Class FetchAddedFilesQueryHandler.
 */
class FetchAddedFilesQueryHandler
{
    /**
     * @var SubversionRepository
     */
    private $repository;

    /**
     * FetchCommittedFilesHandler constructor.
     *
     * @param SubversionRepository $repository
     */
    public function __construct(SubversionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param FetchAddedFilesQuery $query
     *
     * @throws InvalidSubversionDirectoryException
     *
     * @return array
     */
    public function __invoke(FetchAddedFilesQuery $query): array
    {
        $dir = new Directory($query->dir());

        if (!$this->repository->isValidSubversionFolder($dir)) {
            throw new InvalidSubversionDirectoryException($dir);
        }

        return $this->repository->getNewFiles($dir);
    }
}
