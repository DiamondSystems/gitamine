<?php

declare(strict_types=1);

namespace Gitamine\Git\Common\Tests\Domain;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Git\Common\Domain\Branch;

/**
 * Class BranchTest.
 *
 * @covers \Gitamine\Git\Common\Domain\Branch
 */
class BranchTest extends TestCase
{
    public function testShouldBeValidBranch(): void
    {
        $branch = new Branch('master');
        self::assertEquals('master', $branch->name());
    }
}
