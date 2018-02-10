<?php

declare(strict_types=1);

namespace Gitamine\Core\Exception;

use RuntimeException;
use Throwable;

/**
 * Class InfrastructureException.
 */
class InfrastructureException extends RuntimeException
{
    /**
     * InfrastructureException constructor.
     *
     * @param string         $message
     * @param null|Throwable $exception
     */
    public function __construct(string $message, ?Throwable $exception = null)
    {
        parent::__construct($message, 2, $exception);
    }
}
