<?php

declare(strict_types=1);

namespace Gitamine\Tests\Domain;

use Gitamine\Domain\PluginOptions;
use PHPUnit\Framework\TestCase;

/**
 * Class PluginOptionsTest.
 */
class PluginOptionsTest extends TestCase
{
    public function testShouldBeTheSame(): void
    {
        self::assertEquals(
            ['a' => 1, 'b' => 3, 'enabled' => true],
            (new PluginOptions(['a' => 1, 'b' => 3]))->options()
        );
    }
}
