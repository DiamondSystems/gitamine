<?php
declare(strict_types=1);

namespace Gitamine\Git\Tests\Exception;

use Gitamine\Common\Test\TestCase;
use Gitamine\Git\Domain\File;
use Gitamine\Git\Exception\InvalidFileException;

/**
 * Class InvalidFileExceptionTest
 *
 * @covers \Gitamine\Git\Exception\InvalidFileException
 */
class InvalidFileExceptionTest extends TestCase
{
    public function testShouldHaveCorrectCode()
    {
        $exception = new InvalidFileException(new File($this->file('file.txt')));
        self::assertEquals(1, $exception->getCode());
    }
}
