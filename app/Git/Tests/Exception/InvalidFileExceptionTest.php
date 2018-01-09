<?php

declare(strict_types=1);

namespace Gitamine\Git\Tests\Exception;

use Gitamine\Common\Test\TestCase;
use Gitamine\Git\Domain\File;
use Gitamine\Git\Exception\InvalidFileException;

/**
 * Class InvalidFileExceptionTest.
 *
 * @covers \Gitamine\Git\Exception\InvalidFileException
 */
class InvalidFileExceptionTest extends TestCase
{
    public function testShouldHaveCorrectCode(): void
    {
        $this->expectExceptionCode(1);
        new File('file.txt');
    }
}
