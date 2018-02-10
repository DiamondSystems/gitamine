<?php

declare(strict_types=1);

namespace Gitamine\Git\Branch\Tests\Query\Handler;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Git\Branch\Query\GetBranch;
use Gitamine\Git\Branch\Query\Handler\GetBranchHandler;
use Gitamine\Git\Branch\Test\BranchMock;

/**
 * Class GetBranchHandlerTest.
 *
 * @covers \Gitamine\Git\Branch\Query\Handler\GetBranchHandler
 */
class GetBranchHandlerTest extends TestCase
{
    public function testShouldGetBranch(): void
    {
        $branch = new BranchMock();
        $branch->mockGetCurrentBranch('master');

        $handler = new GetBranchHandler($branch->mock());
        $result  = $handler(new GetBranch());

        self::assertEquals(
            'master',
            $result
        );
    }
}
