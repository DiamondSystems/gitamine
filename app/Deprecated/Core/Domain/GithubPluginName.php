<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Domain;

use Gitamine\Deprecated\Core\Exception\GithubProjectDoesNotExist;

/**
 * Class GithubPluginName.
 */
class GithubPluginName
{
    /**
     * @var string
     */
    private $plugin;

    /**
     * GithubPluginName constructor.
     *
     * @param string $plugin
     *
     * @throws GithubProjectDoesNotExist
     */
    public function __construct(string $plugin)
    {
        $this->plugin = $plugin;

        if (2 !== \mb_substr_count($plugin, '/') + 1) {
            throw new GithubProjectDoesNotExist($plugin);
        }
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->plugin;
    }
}
