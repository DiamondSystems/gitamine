<?php
declare(strict_types=1);

namespace Gitamine\Exception;

use Gitamine\Domain\RegExp;
use RuntimeException;
use Throwable;

/**
 * Class InvalidRegularExpressionException
 * @package Gitamine\Exception
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
