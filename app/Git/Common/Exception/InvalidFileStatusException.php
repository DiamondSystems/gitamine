<?php

declare(strict_types=1);

namespace Gitamine\Git\Common\Exception;

use Gitamine\Git\Common\Domain\FileStatus;
use RuntimeException;
use Throwable;

/**
 * Class InvalidFileStatusException.
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
