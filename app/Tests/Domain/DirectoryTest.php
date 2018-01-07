<?php

declare(strict_types=1);

namespace Gitamine\Tests\Domain;

use Gitamine\Domain\Directory;
use Gitamine\Exception\InvalidDirException;
use Gitamine\Exception\InvalidFileException;
use PHPUnit\Framework\TestCase;

/**
 * Class DirectoryTest.
 *
 * @coversNothing
 */
class DirectoryTest extends TestCase
{
    public function testShouldWork(): void
    {
        $dir = (new Directory(__DIR__))->openDir('../__assets');
        self::assertEquals('folder1', $dir->openDir('folder1')->name());
        self::assertEquals($dir->dir() . '/file1.txt', $dir->openFile('file1.txt')->file());
        self::assertEquals('file1.txt', $dir->openFile('file1.txt')->name());
        self::assertEquals([$dir->openFile('file1.txt')], $dir->files());
        self::assertEquals([$dir->openDir('folder1')], $dir->directories());
    }

    public function testShouldThrowInvalidDirException(): void
    {
        $this->expectException(InvalidDirException::class);
        new Directory('asd');
    }

    public function testShouldThrowInvalid(): void
    {
        $this->expectException(InvalidFileException::class);
        (new Directory(__DIR__))->openFile('anything');
    }
}
