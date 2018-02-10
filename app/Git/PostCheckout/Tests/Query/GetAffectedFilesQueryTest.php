<?php

declare(strict_types=1);

namespace Gitamine\Git\PostCheckout\Tests\Query;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Git\PostCheckout\Query\GetAffectedFiles;

/**
 * Class GetAffectedFilesQueryTest.
 *
 * @covers \Gitamine\Git\PostCheckout\Query\GetAffectedFiles
 */
class GetAffectedFilesQueryTest extends TestCase
{
    public function testShouldHaveValidConstructors(): void
    {
        $query = new GetAffectedFiles('master', 'AD');
        self::assertEquals('master', $query->source());
        self::assertEquals('.*', $query->filter());
        self::assertEquals('AD', $query->status());

        $query = new GetAffectedFiles('master', 'M', 'test');
        self::assertEquals('master', $query->source());
        self::assertEquals('test', $query->filter());
        self::assertEquals('M', $query->status());
    }
}
