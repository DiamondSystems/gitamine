<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Exception;

use Gitamine\Deprecated\Core\Domain\RegExp;
use RuntimeException;
use Throwable;

/**
 * Class InvalidRegularExpressionException.
 */
class InvalidRegularExpressionException extends RuntimeException
{
    /**
     * InvalidRegularExpressionException constructor.
     *
     * @param RegExp         $expression
     * @param Throwable|null $previous
     */
    public function __construct(RegExp $expression, Throwable $previous = null)
    {
        parent::__construct("Invalid regular expression '{$expression->regExp()}'", 1, $previous);
    }
}
