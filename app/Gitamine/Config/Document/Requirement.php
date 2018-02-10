<?php

declare(strict_types=1);

namespace Gitamine\Gitamine\Config\Document;

/**
 * Class Requirement
 */
class Requirement
{
    /**
     * @var string
     */
    private $plugin;

    /**
     * @var string
     */
    private $alias;

    /**
     * Requirement constructor.
     *
     * @param string $plugin
     * @param string $alias
     */
    public function __construct(string $plugin, string $alias)
    {
        $this->plugin = $plugin;
        $this->alias  = $alias;
    }

    /**
     * @return string
     */
    public function plugin(): string
    {
        return $this->plugin;
    }

    /**
     * @return string
     */
    public function alias(): string
    {
        return $this->alias;
    }
}
