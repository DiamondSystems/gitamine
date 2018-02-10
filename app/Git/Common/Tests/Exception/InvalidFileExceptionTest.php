<?php

declare(strict_types=1);

namespace Gitamine\Git\Common\Tests\Exception;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Git\Common\Domain\File;

/**
 * Class InvalidFileExceptionTest.
 *
 * @covers \Gitamine\Git\Common\Exception\InvalidFileException
 */
class InvalidFileExceptionTest extends TestCase
{
    public function testShouldHaveCorrectCode(): void
    {
        $this->expectExceptionCode(1);
        new File('file.txt');
    }
}
