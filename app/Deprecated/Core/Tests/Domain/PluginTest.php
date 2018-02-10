<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Tests\Domain;

use Gitamine\Deprecated\Core\Domain\Plugin;
use PHPUnit\Framework\TestCase;

/**
 * Class PluginTest.
 *
 * @coversNothing
 */
class PluginTest extends TestCase
{
    public function testShouldThrowPluginNotInstalledException(): void
    {
        $plugin = new Plugin('test');
        self::assertEquals('test', $plugin->name());
    }
}
