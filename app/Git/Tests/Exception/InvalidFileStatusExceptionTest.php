<?php

declare(strict_types=1);

namespace Gitamine\Git\Tests\Exception;

use Gitamine\Common\Test\TestCase;
use Gitamine\Git\Domain\FileStatus;

/**
 * Class InvalidFileStatusException
 *
 * @covers \Gitamine\Git\Exception\InvalidFileStatusException
 */
class InvalidFileStatusExceptionTest extends TestCase
{
    public function testShouldHaveCorrectCode(): void
    {
        $this->expectExceptionCode(1);
        new FileStatus('amd');
    }
}
