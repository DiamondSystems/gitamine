<?php

declare(strict_types=1);

namespace Gitamine\Git\Common\Tests\Domain;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Git\Common\Domain\FileStatus;
use Gitamine\Git\Common\Exception\InvalidFileStatusException;

/**
 * Class FileStatustTest.
 *
 * @covers \Gitamine\Git\Common\Domain\FileStatus
 */
class FileStatustTest extends TestCase
{
    public function testShouldBeValidFileStatus(): void
    {
        $file = new FileStatus('');
        self::assertEquals('', $file->status());

        $file = new FileStatus('AMD');
        self::assertEquals('AMD', $file->status());
    }

    public function testShouldThrowInvalidFileStatusException(): void
    {
        $this->expectException(InvalidFileStatusException::class);

        new FileStatus('amd');
    }
}
