<?php

declare(strict_types=1);

namespace Gitamine\Git\Tests\Domain;

use Gitamine\Common\Test\TestCase;
use Gitamine\Domain\RegExp;
use Gitamine\Git\Domain\File;
use Gitamine\Git\Exception\InvalidFileException;

/**
 * Class FileTest.
 *
 * @covers \Gitamine\Git\Domain\File
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
