<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Query;

/**
 * Class GetConfiguratedPluginsQuery.
 */
class GetConfiguratedPluginsQuery
{
    /**
     * @var string
     */
    private $event;

    /**
     * GetConfiguratedPluginsQuery constructor.
     *
     * @param string $event
     */
    public function __construct(string $event)
    {
        $this->event = $event;
    }

    /**
     * @return string
     */
    public function event(): string
    {
        return $this->event;
    }
}
