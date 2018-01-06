<?php

declare(strict_types=1);

namespace Gitamine\Infrastructure;

use Gitamine\Domain\Directory;
use Gitamine\Domain\File;
use Gitamine\Exception\InvalidSubversionDirectoryException;

/**
 * Interface SubversionRepository.
 */
interface SubversionRepository
{
    /**
     * @param Directory $dir
     *
     * @return bool
     */
    public function isValidSubversionFolder(Directory $dir): bool;

    /**
     * @param Directory $dir
     *
     * @throws InvalidSubversionDirectoryException
     *
     * @return Directory
     */
    public function getRootDir(Directory $dir): Directory;

    /**
     * @param Directory $dir
     *
     * @throws InvalidSubversionDirectoryException
     *
     * @return string[]
     */
    public function getNewFiles(Directory $dir): array;

    /**
     * @param Directory $dir
     *
     * @throws InvalidSubversionDirectoryException
     *
     * @return string[]
     */
    public function getUpdatedFiles(Directory $dir): array;

    /**
     * @param Directory $dir
     *
     * @throws InvalidSubversionDirectoryException
     *
     * @return string[]
     */
    public function getDeletedFiles(Directory $dir): array;

    /**
     * @param Directory $dir
     *
     * @throws InvalidSubversionDirectoryException
     *
     * @return array
     */
    public function getBranchName(Directory $dir): array;

    /**
     * @param Directory $dir
     * @param string    $source
     * @param string    $destiny
     *
     * @throws InvalidSubversionDirectoryException
     *
     * @return File[]
     */
    public function getFilesModifiedOnBranch(Directory $dir, string $source, string $destiny): array;
}
