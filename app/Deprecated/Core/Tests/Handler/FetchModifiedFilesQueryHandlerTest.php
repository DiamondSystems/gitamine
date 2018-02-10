<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Tests\Handler;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Deprecated\Core\Exception\InvalidSubversionDirectoryException;
use Gitamine\Deprecated\Core\Query\Handler\FetchModifiedFilesQueryHandler;
use Gitamine\Deprecated\Core\Query\FetchModifiedFilesQuery;
use Gitamine\Deprecated\Core\Test\VersionControlMock;

/**
 * Class FetchModifiedFilesQueryHandlerTest.
 *
 * @coversNothing
 */
class FetchModifiedFilesQueryHandlerTest extends TestCase
{
    /**
     * @throws InvalidSubversionDirectoryException
     */
    public function testShouldFetchAddedFiles(): void
    {
        $dir  = '/';
        $repo = VersionControlMock::create();

        $repo->shouldBeValidVersionControlFolder($dir, true);
        $repo->shouldGetModifiedFiles($dir, ['/modified.txt']);

        $handler = new FetchModifiedFilesQueryHandler($repo->versionControl());
        self::assertEquals(
            ['/modified.txt'],
            $handler(new FetchModifiedFilesQuery($dir))
        );
    }

    /**
     * @throws InvalidSubversionDirectoryException
     */
    public function testShouldThrowInvalidSubversionDirectoryException(): void
    {
        $this->expectException(InvalidSubversionDirectoryException::class);

        $dir = '/';

        $repo = VersionControlMock::create();

        $repo->shouldBeValidVersionControlFolder($dir, false);

        $handler = new FetchModifiedFilesQueryHandler($repo->versionControl());
        $handler(new FetchModifiedFilesQuery($dir));
    }
}
