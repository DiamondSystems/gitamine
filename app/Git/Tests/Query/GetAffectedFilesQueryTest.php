<?php
declare(strict_types=1);

namespace Gitamine\Git\Tests\Query;

use Gitamine\Common\Test\TestCase;
use Gitamine\Git\Query\PostCheckout\GetAffectedFilesQuery;

/**
 * Class GetAffectedFilesQueryTest
 *
 * @covers \Gitamine\Git\Query\PostCheckout\GetAffectedFilesQuery
 */
class GetAffectedFilesQueryTest extends TestCase
{
    public function testShouldHaveValidConstructors()
    {
        $query = new GetAffectedFilesQuery();
        self::assertNull($query->source());
        self::assertEquals('.*', $query->filter());

        $query = new GetAffectedFilesQuery('master');
        self::assertEquals('master', $query->source());
        self::assertEquals('.*', $query->filter());

        $query = new GetAffectedFilesQuery(null, 'test');
        self::assertNull($query->source());
        self::assertEquals('test', $query->filter());
    }
}
