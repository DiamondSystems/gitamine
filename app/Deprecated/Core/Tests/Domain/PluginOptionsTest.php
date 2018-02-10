<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Tests\Domain;

use Gitamine\Deprecated\Core\Domain\PluginOptions;
use PHPUnit\Framework\TestCase;

/**
 * Class PluginOptionsTest.
 *
 * @coversNothing
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
