<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Domain;

use Gitamine\Deprecated\Core\Exception\InvalidRegularExpressionException;

/**
 * Class RegExp.
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

        if (false !== @\preg_match($regExp, '')) {
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
        return 1 === \preg_match($this->regExp, $text);
    }
}
