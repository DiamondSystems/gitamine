<?php

declare(strict_types=1);

namespace Gitamine\Git\Tests\Query\PreCommit;

use Gitamine\Common\Test\TestCase;
use Gitamine\Git\Query\PreCommit\GetAffectedFilesQuery;

/**
 * Class GetAffectedFilesQueryTest.
 *
 * @covers \Gitamine\Git\Query\PreCommit\GetAffectedFilesQuery
 */
class GetAffectedFilesQueryTest extends TestCase
{
    public function testShouldHaveValidConstructors(): void
    {
        $query = new GetAffectedFilesQuery('AD');
        self::assertEquals('AD', $query->status());

        $query = new GetAffectedFilesQuery('M', 'test');
        self::assertEquals('M', $query->status());
    }
}
