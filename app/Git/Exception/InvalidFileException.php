<?php

declare(strict_types=1);

namespace Gitamine\Git\Exception;

use Gitamine\Git\Domain\File;
use RuntimeException;
use Throwable;

/**
 * Class InvalidFileException.
 */
final class InvalidFileException extends RuntimeException
{
    /**
     * InvalidFileException constructor.
     *
     * @param File           $file
     * @param Throwable|null $previous
     */
    public function __construct(File $file, Throwable $previous = null)
    {
        parent::__construct("File '{$file->filename()}' not found", 1, $previous);
    }
}
