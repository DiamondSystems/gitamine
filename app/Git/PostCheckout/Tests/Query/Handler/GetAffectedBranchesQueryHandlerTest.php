<?php

declare(strict_types=1);

namespace Gitamine\Git\Tests\PostCheckout\Query\Handler;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Git\PostCheckout\Query\GetAffectedBranches;
use Gitamine\Git\PostCheckout\Query\Handler\GetAffectedBranchesHandler;
use Gitamine\Git\PostCheckout\Test\PostCheckoutMock;

/**
 * Class GetAffectedBranchesQueryHandlerTest.
 *
 * @covers \Gitamine\Git\PostCheckout\Query\Handler\GetAffectedBranchesHandler
 */
class GetAffectedBranchesQueryHandlerTest extends TestCase
{
    public function testShouldGetAffectedBranches(): void
    {
        $postCheckout = new PostCheckoutMock();
        $postCheckout->mockGetAffectedBranches('master', 'develop');

        $handler  = new GetAffectedBranchesHandler($postCheckout->mock());
        $branches = $handler(new GetAffectedBranches());

        self::assertEquals(['master', 'develop'], $branches);
    }
}
