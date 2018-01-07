<?php

declare(strict_types=1);

namespace Gitamine\Tests\Domain;

use Gitamine\Domain\Plugin;
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
