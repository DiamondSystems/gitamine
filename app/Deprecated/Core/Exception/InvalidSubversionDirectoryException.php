<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Exception;

use Exception;
use Gitamine\Deprecated\Core\Domain\Directory;
use Throwable;

/**
 * Class InvalidSubversionDirectoryException.
 */
class InvalidSubversionDirectoryException extends Exception
{
    /**
     * InvalidSubversionDirectoryException constructor.
     *
     * @param Directory      $dir
     * @param Throwable|null $previous
     */
    public function __construct(Directory $dir, Throwable $previous = null)
    {
        parent::__construct("Invalid subversion repository '{$dir->dir()}'", 1, $previous);
    }
}
