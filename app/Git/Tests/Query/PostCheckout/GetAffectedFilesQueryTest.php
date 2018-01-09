<?php

declare(strict_types=1);

namespace Gitamine\Git\Tests\Query\PostCheckout;

use Gitamine\Common\Test\TestCase;
use Gitamine\Git\Query\PostCheckout\GetAffectedFilesQuery;

/**
 * Class GetAffectedFilesQueryTest.
 *
 * @covers \Gitamine\Git\Query\PostCheckout\GetAffectedFilesQuery
 */
class GetAffectedFilesQueryTest extends TestCase
{
    public function testShouldHaveValidConstructors(): void
    {
        $query = new GetAffectedFilesQuery('master', 'AD');
        self::assertEquals('master', $query->source());
        self::assertEquals('.*', $query->filter());
        self::assertEquals('AD', $query->status());

        $query = new GetAffectedFilesQuery('master', 'M', 'test');
        self::assertEquals('master', $query->source());
        self::assertEquals('test', $query->filter());
        self::assertEquals('M', $query->status());
    }
}
