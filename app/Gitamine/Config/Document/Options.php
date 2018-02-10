<?php

declare(strict_types=1);

namespace Gitamine\Gitamine\Config\Document;

/**
 * Class Options
 */
class Options
{
    public const FULL       = 3;
    public const ONLY_ERROR = 2;
    public const MINIMAL    = 1;
    public const NONE       = 0;

    /**
     * @var int
     */
    private $verboseLevel;

    /**
     * Options constructor.
     *
     * @param int $verboseLevel
     */
    public function __construct(int $verboseLevel)
    {
        $this->verboseLevel = $verboseLevel;
    }

    /**
     * @return int
     */
    public function verboseLevel(): int
    {
        return $this->verboseLevel;
    }
}
