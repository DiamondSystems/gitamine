<?php
declare(strict_types=1);

namespace Gitamine\Git\Tests\Domain;

use Gitamine\Common\Test\TestCase;
use Gitamine\Git\Domain\Branch;

/**
 * Class BranchTest
 *
 * @covers \Gitamine\Git\Domain\Branch
 */
class BranchTest extends TestCase
{
    public function testShouldBeValidBranch()
    {
        $branch = new Branch('master');
        self::assertEquals('master', $branch->name());
    }
}
