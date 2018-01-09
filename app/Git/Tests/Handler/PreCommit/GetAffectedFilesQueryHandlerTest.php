<?php

declare(strict_types=1);

namespace Gitamine\Git\Tests\Handler\PreCommit;

use Gitamine\Common\Test\TestCase;
use Gitamine\Git\Handler\PreCommit\GetAffectedFilesQueryHandler;
use Gitamine\Git\Query\PreCommit\GetAffectedFilesQuery;
use Gitamine\Git\Test\PreCommitMock;

/**
 * Class GetAffectedFilesQueryHandlerTest.
 *
 * @covers \Gitamine\Git\Handler\PreCommit\GetAffectedFilesQueryHandler
 */
class GetAffectedFilesQueryHandlerTest extends TestCase
{
    public function testShouldGetFilesGivenOriginBranch(): void
    {
        $files = [$this->file('file.txt')];

        $preCommit = new PreCommitMock();
        $preCommit->mockGetFiles($files);

        $handler = new GetAffectedFilesQueryHandler($preCommit->mock());
        $result  = $handler(new GetAffectedFilesQuery(''));

        self::assertEquals(
            $files,
            $result
        );
    }
}
