<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Tests\Domain;

use Gitamine\Deprecated\Core\Domain\GithubPlugin;
use Gitamine\Deprecated\Core\Domain\GithubPluginName;
use Gitamine\Deprecated\Core\Domain\GithubPluginVersion;
use Gitamine\Deprecated\Core\Exception\GithubProjectDoesNotExist;
use PHPUnit\Framework\TestCase;

/**
 * Class GithubPluginTest.
 *
 * @coversNothing
 */
class GithubPluginTest extends TestCase
{
    public function testReturnValidValues(): void
    {
        $plugin = new GithubPlugin(
            new GithubPluginName('test/test'),
            new GithubPluginVersion('master')
        );

        self::assertEquals('test/test', $plugin->name()->name());
        self::assertEquals('master', $plugin->version()->version());
    }

    public function testShoulThrowGithubProjectDoesNotExistException(): void
    {
        $this->expectException(GithubProjectDoesNotExist::class);

        new GithubPlugin(
            new GithubPluginName('test'),
            new GithubPluginVersion('master')
        );
    }
}
