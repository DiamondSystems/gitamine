<?php
declare(strict_types=1);

namespace Gitamine\Domain;

use Gitamine\Exception\InvalidRegularExpressionException;

/**
 * Class RegExp
 * @package Gitamine\Domain
 */
class RegExp
{
    /**
     * @var string
     */
    private $regExp;

    /**
     * RegExp constructor.
     *
     * @param string $regExp
     */
    public function __construct(string $regExp)
    {
        $this->regExp = "/{$regExp}/";

        if (@preg_match($regExp, '') !== false) {
            throw new InvalidRegularExpressionException($this);
        }
    }

    /**
     * @return string
     */
    public function regExp(): string
    {
        return $this->regExp;
    }

    /**
     * @param string $text
     *
     * @return bool
     */
    public function match(string $text): bool
    {
        return 1 === preg_match($this->regExp, $text);
    }
}
