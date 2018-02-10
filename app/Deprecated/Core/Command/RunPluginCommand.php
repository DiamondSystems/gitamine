<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Command;

/**
 * Class RunPluginCommand.
 */
class RunPluginCommand
{
    /**
     * @var string
     */
    private $plugin;

    /**
     * @var string
     */
    private $event;

    /**
     * @var string
     */
    private $params;

    /**
     * RunPluginCommand constructor.
     *
     * @param string $plugin
     * @param string $event
     * @param string $params
     */
    public function __construct(string $plugin, string $event, ?string $params = '')
    {
        $this->plugin = $plugin;
        $this->event  = $event;
        $this->params = $params;
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
    public function event(): string
    {
        return $this->event;
    }

    /**
     * @return string
     */
    public function params(): string
    {
        return $this->params;
    }
}
