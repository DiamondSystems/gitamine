<?php

declare(strict_types=1);

namespace Gitamine\Git\Exception;

use Gitamine\Git\Domain\File;
use Gitamine\Git\Domain\FileStatus;
use RuntimeException;
use Throwable;

/**
 * Class InvalidFileStatusException
 * @package Gitamine\Git\Exception
 */
final class InvalidFileStatusException extends RuntimeException
{
    /**
     * InvalidFileException constructor.
     *
     * @param FileStatus     $status
     * @param Throwable|null $previous
     */
    public function __construct(FileStatus $status, Throwable $previous = null)
    {
        parent::__construct("'{$status->status()}' is not valid, only valid characters are AMD", 1, $previous);
    }
}
