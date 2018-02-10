<?php

declare(strict_types=1);

namespace Gitamine\Git\PreCommit\Tests\Query;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Git\PreCommit\Query\GetAffectedFiles;

/**
 * Class GetAffectedFilesQueryTest.
 *
 * @covers \Gitamine\Git\PreCommit\Query\GetAffectedFiles
 */
class GetAffectedFilesQueryTest extends TestCase
{
    public function testShouldHaveValidConstructors(): void
    {
        $query = new GetAffectedFiles('AD');
        self::assertEquals('AD', $query->status());

        $query = new GetAffectedFiles('M', 'test');
        self::assertEquals('M', $query->status());
        self::assertEquals('test', $query->filter());
    }
}
