<?php

declare(strict_types=1);

namespace Gitamine\Git\PreCommit\Tests\Query\Handler;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Git\PreCommit\Query\GetAffectedFiles;
use Gitamine\Git\PreCommit\Query\Handler\GetAffectedFilesHandler;
use Gitamine\Git\PreCommit\Test\PreCommitMock;

/**
 * Class GetAffectedFilesQueryHandlerTest.
 *
 * @covers \Gitamine\Git\PreCommit\Query\Handler\GetAffectedFilesHandler
 */
class GetAffectedFilesQueryHandlerTest extends TestCase
{
    public function testShouldGetFilesGivenOriginBranch(): void
    {
        $files = [$this->file('file.txt')];

        $preCommit = new PreCommitMock();
        $preCommit->mockGetStagedFiles($files);

        $handler = new GetAffectedFilesHandler($preCommit->mock());
        $result  = $handler(new GetAffectedFiles(''));

        self::assertEquals(
            $files,
            $result
        );
    }
}
