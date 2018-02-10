<?php

declare(strict_types=1);

namespace Gitamine\Git\Common\Tests\Domain;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Deprecated\Core\Domain\RegExp;
use Gitamine\Git\Common\Domain\File;
use Gitamine\Git\Common\Exception\InvalidFileException;

/**
 * Class FileTest.
 *
 * @covers \Gitamine\Git\Common\Domain\File
 */
class FileTest extends TestCase
{
    public function testShouldBeValidFile(): void
    {
        $file = new File($this->file('file.txt'));
        self::assertEquals($this->file('file.txt'), $file->file());
        self::assertEquals('file.txt', $file->filename());
        self::assertTrue($file->match(new RegExp('e\.txt')));
        self::assertFalse($file->match(new RegExp('etxt')));
    }

    public function testShouldThrowInvalidFileException(): void
    {
        $this->expectException(InvalidFileException::class);

        new File('no file');
    }
}
