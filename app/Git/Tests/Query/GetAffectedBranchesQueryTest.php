<?php
declare(strict_types=1);

namespace Gitamine\Git\Tests\Query;

use Gitamine\Common\Test\TestCase;
use Gitamine\Git\Query\PostCheckout\GetAffectedBranchesQuery;

/**
 * Class GetAffectedBranchesQueryTest
 *
 * @covers \Gitamine\Git\Query\PostCheckout\GetAffectedBranchesQuery
 */
class GetAffectedBranchesQueryTest extends TestCase
{
    public function testShouldHaveValidConstructors()
    {
        $query = new GetAffectedBranchesQuery();
        self::assertNotNull($query);
    }
}
