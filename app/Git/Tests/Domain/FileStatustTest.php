<?php

declare(strict_types=1);

namespace Gitamine\Git\Tests\Domain;

use Gitamine\Common\Test\TestCase;
use Gitamine\Git\Domain\FileStatus;
use Gitamine\Git\Exception\InvalidFileStatusException;

/**
 * Class FileStatustTest
 *
 * @covers \Gitamine\Git\Domain\FileStatus
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
