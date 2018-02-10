<?php

declare(strict_types=1);

namespace Gitamine\Gitamine\Config\Infrastructure;

use Gitamine\Gitamine\Config\Document\Options;
use Gitamine\Gitamine\Config\Document\Requirement;

/**
 * Interface GitamineConfigReader
 */
interface GitamineConfigReader
{
    /**
     * @return Options
     */
    public function getOptions(): Options;

    /**
     * @return Requirement[]
     */
    public function getRequirements(): array;
    
    public function getPluginsForEvent(Event $event);

    public function getPluginForEventAndName(PluginName $name, Event $event);
}
