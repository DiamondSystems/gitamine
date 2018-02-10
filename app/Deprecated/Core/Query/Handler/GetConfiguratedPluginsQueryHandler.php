<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Query\Handler;

use App\Prooph\QueryBus;
use Gitamine\Deprecated\Core\Domain\Directory;
use Gitamine\Deprecated\Core\Domain\Event;
use Gitamine\Deprecated\Core\Infrastructure\GitamineConfig;
use Gitamine\Deprecated\Core\Query\GetConfiguratedPluginsQuery;
use Gitamine\Deprecated\Core\Query\GetProjectDirectoryQuery;

/**
 * Class GetConfiguratedPluginsQueryHandler.
 */
class GetConfiguratedPluginsQueryHandler
{
    /**
     * @var GitamineConfig
     */
    private $gitamine;

    /**
     * @var QueryBus
     */
    private $bus;

    /**
     * GetConfiguratedPluginsQueryHandler constructor.
     *
     * @param QueryBus       $bus
     * @param GitamineConfig $gitamine
     */
    public function __construct(QueryBus $bus, GitamineConfig $gitamine)
    {
        $this->gitamine = $gitamine;
        $this->bus      = $bus;
    }

    /**
     * @param GetConfiguratedPluginsQuery $query
     *
     * @return string[]
     */
    public function __invoke(GetConfiguratedPluginsQuery $query): array
    {
        $dir     = new Directory($this->bus->dispatch(new GetProjectDirectoryQuery()));
        $plugins = $this->gitamine->getPluginList($dir, new Event($query->event()));
        $list    = [];

        foreach ($plugins as $plugin) {
            $list[] = $plugin->name();
        }

        return $list;
    }
}
