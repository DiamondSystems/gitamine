<?php

declare(strict_types=1);

namespace Gitamine\Git\Domain;

/**
 * Class Branch.
 */
final class Branch
{
    /**
     * @var string
     */
    private $name;

    /**
     * Branch constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }
}
