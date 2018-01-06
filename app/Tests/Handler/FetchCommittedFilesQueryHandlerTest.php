<?php

declare(strict_types=1);

namespace Gitamine\Tests\Handler;

use Gitamine\Common\Test\TestCase;
use Gitamine\Exception\InvalidSubversionDirectoryException;
use Gitamine\Handler\FetchCommittedFilesQueryHandler;
use Gitamine\Query\FetchCommittedFilesQuery;
use Gitamine\Test\VersionControlMock;

/**
 * Class FetchCommittedFilesQueryHandlerTest.
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
