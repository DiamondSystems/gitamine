<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Tests\Handler;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Deprecated\Core\Exception\InvalidSubversionDirectoryException;
use Gitamine\Deprecated\Core\Query\Handler\FetchCommittedFilesQueryHandler;
use Gitamine\Deprecated\Core\Query\FetchCommittedFilesQuery;
use Gitamine\Deprecated\Core\Test\VersionControlMock;

/**
 * Class FetchCommittedFilesQueryHandlerTest.
 *
 * @coversNothing
 */
class FetchCommittedFilesQueryHandlerTest extends TestCase
{
    /**
     * @throws InvalidSubversionDirectoryException
     */
    public function testShouldFetchAddedFiles(): void
    {
        $dir  = '/';
        $repo = VersionControlMock::create();

        $repo->shouldBeValidVersionControlFolder($dir, true);

        $repo->shouldGetNewFiles($dir, ['/added.txt']);
        $repo->shouldGetModifiedFiles($dir, ['/modified.txt']);

        $handler = new FetchCommittedFilesQueryHandler($repo->versionControl());
        self::assertEquals(
            ['/added.txt', '/modified.txt'],
            $handler(new FetchCommittedFilesQuery($dir))
        );
    }

    /**
     * @throws InvalidSubversionDirectoryException
     */
    public function testShouldThrowInvalidSubversionDirectoryException(): void
    {
        $this->expectException(InvalidSubversionDirectoryException::class);

        $dir  = '/';
        $repo = VersionControlMock::create();

        $repo->shouldBeValidVersionControlFolder($dir, false);

        $handler = new FetchCommittedFilesQueryHandler($repo->versionControl());
        $handler(new FetchCommittedFilesQuery($dir));
    }
}
