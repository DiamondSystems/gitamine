<?php

declare(strict_types=1);

namespace Gitamine\Tests\Domain;

use Gitamine\Domain\GithubPlugin;
use Gitamine\Domain\GithubPluginName;
use Gitamine\Domain\GithubPluginVersion;
use Gitamine\Exception\GithubProjectDoesNotExist;
use PHPUnit\Framework\TestCase;

/**
 * Class GithubPluginTest.
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
