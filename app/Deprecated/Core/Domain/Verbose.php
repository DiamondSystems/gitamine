<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Domain;

/**
 * Class Verbose.
 */
class Verbose
{
    public const FULL        = 2;
    public const ONLY_ERRORS = 1;
    public const NONE        = 0;

    /**
     * @var int
     */
    private $level;

    /**
     * Verbose constructor.
     *
     * @param int $level
     */
    public function __construct(int $level)
    {
        $this->level = $level;
    }

    /**
     * @return int
     */
    public function level(): int
    {
        return $this->level;
    }
}
