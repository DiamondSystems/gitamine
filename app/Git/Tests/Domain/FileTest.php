<?php
declare(strict_types=1);

namespace Gitamine\Git\Tests\Domain;

use Gitamine\Common\Test\TestCase;
use Gitamine\Git\Domain\File;
use Gitamine\Git\Exception\InvalidFileException;

/**
 * Class FileTest
 *
 * @covers \Gitamine\Git\Domain\File
 */
class FileTest extends TestCase
{
    public function testShouldBeValidFile()
    {
        $file = new File($this->file('file.txt'));
        self::assertEquals($this->file('file.txt'), $file->file());
        self::assertEquals('file.txt', $file->filename());
    }

    public function testShouldThrowInvalidFileException()
    {
        $this->expectException(InvalidFileException::class);

        new File('no file');
    }
}
