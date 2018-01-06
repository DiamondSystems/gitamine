<?php

declare(strict_types=1);

namespace Gitamine\Domain;

use Gitamine\Exception\PluginNotInstalledException;

/**
 * Class Plugin.
 */
class Plugin
{
    /**
     * @var string
     */
    private $name;

    /**
     * Plugin constructor.
     *
     * @param string $plugin
     */
    public function __construct(string $plugin)
    {
        /* TODO improve quality
        if (!\is_dir($_SERVER['HOME'] . '/.gitamine/plugins/' . $plugin)) {
            throw new PluginNotInstalledException("${plugin} is not installed");
        }
        */
        $this->name = $plugin;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }
}
