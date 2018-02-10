<?php

declare(strict_types=1);

namespace Gitamine\Git\Common\Tests\Exception;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Git\Common\Domain\FileStatus;

/**
 * Class InvalidFileStatusException.
 *
 * @covers \Gitamine\Git\Common\Exception\InvalidFileStatusException
 */
class InvalidFileStatusExceptionTest extends TestCase
{
    public function testShouldHaveCorrectCode(): void
    {
        $this->expectExceptionCode(1);
        new FileStatus('amd');
    }
}
