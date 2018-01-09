<?php

declare(strict_types=1);

namespace Gitamine\Git\Tests\Handler\PostCheckout;

use Gitamine\Common\Test\TestCase;
use Gitamine\Git\Handler\PostCheckout\GetAffectedBranchesQueryHandler;
use Gitamine\Git\Query\PostCheckout\GetAffectedBranchesQuery;
use Gitamine\Git\Test\PostCheckoutMock;

/**
 * Class GetAffectedBranchesQueryHandlerTest.
 *
 * @covers \Gitamine\Git\Handler\PostCheckout\GetAffectedBranchesQueryHandler
 */
class GetAffectedBranchesQueryHandlerTest extends TestCase
{
    public function testShouldGetAffectedBranches(): void
    {
        $postCheckout = new PostCheckoutMock();
        $postCheckout->mockGetAffectedBranches('master', 'develop');

        $handler  = new GetAffectedBranchesQueryHandler($postCheckout->mock());
        $branches = $handler(new GetAffectedBranchesQuery());

        self::assertEquals(['master', 'develop'], $branches);
    }
}
