<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Tests\Handler;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Deprecated\Core\Exception\InvalidSubversionDirectoryException;
use Gitamine\Deprecated\Core\Query\Handler\FetchAddedFilesQueryHandler;
use Gitamine\Deprecated\Core\Query\FetchAddedFilesQuery;
use Gitamine\Deprecated\Core\Test\VersionControlMock;

/**
 * Class FetchAddedFilesQueryHandlerTest.
 *
 * @coversNothing
 */
class FetchAddedFilesQueryHandlerTest extends TestCase
{
    /**
     * @throws InvalidSubversionDirectoryException
     */
    public function testShouldFetchAddedFiles(): void
    {
        $dir   = '/';
        $files = ['/test.txt'];

        $repo = VersionControlMock::create();

        $repo->shouldBeValidVersionControlFolder($dir, true);
        $repo->shouldGetNewFiles($dir, $files);

        $handler = new FetchAddedFilesQueryHandler($repo->versionControl());
        self::assertEquals(
            $files,
            $handler(new FetchAddedFilesQuery($dir))
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

        $handler = new FetchAddedFilesQueryHandler($repo->versionControl());
        $handler(new FetchAddedFilesQuery($dir));
    }
}
