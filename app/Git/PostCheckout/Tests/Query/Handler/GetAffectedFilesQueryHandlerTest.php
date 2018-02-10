<?php

declare(strict_types=1);

namespace Gitamine\Git\PostCheckout\Tests\Query\Handler;

use Gitamine\Deprecated\Core\Common\Test\TestCase;
use Gitamine\Git\PostCheckout\Query\GetAffectedFiles;
use Gitamine\Git\PostCheckout\Query\Handler\GetAffectedFilesHandler;
use Gitamine\Git\PostCheckout\Test\PostCheckoutMock;

/**
 * Class GetAffectedFilesQueryHandlerTest.
 *
 * @covers \Gitamine\Git\PostCheckout\Query\Handler\GetAffectedFilesHandler
 */
class GetAffectedFilesQueryHandlerTest extends TestCase
{
    public function testShouldGetFilesGivenOriginBranch(): void
    {
        $files = [$this->file('file.txt')];

        $postCheckout = new PostCheckoutMock();
        $postCheckout->mockGetAffectedBranches('master', 'develop');
        $postCheckout->mockGetFiles('feature', 'develop', $files);

        $handler = new GetAffectedFilesHandler($postCheckout->mock());
        $result  = $handler(new GetAffectedFiles('feature', ''));

        self::assertEquals(
            $files,
            $result
        );
    }

    public function testShouldGetFilesWithFilters(): void
    {
        $files = [$this->file('file.txt'), $this->file('file2.txt')];

        $postCheckout = new PostCheckoutMock();
        $postCheckout->mockGetAffectedBranches('master', 'develop');
        $postCheckout->mockGetFiles('master', 'develop', $files);

        $handler = new GetAffectedFilesHandler($postCheckout->mock());
        $result  = $handler(new GetAffectedFiles('master', '', 'file2.txt'));

        self::assertEquals(
            [$files[1]],
            $result
        );
    }
}
