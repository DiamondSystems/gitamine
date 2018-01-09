<?php

declare(strict_types=1);

namespace Gitamine\Git\Tests\Handler\PostCheckout;

use Gitamine\Common\Test\TestCase;
use Gitamine\Git\Handler\PostCheckout\GetAffectedFilesQueryHandler;
use Gitamine\Git\Query\PostCheckout\GetAffectedFilesQuery;
use Gitamine\Git\Test\PostCheckoutMock;

/**
 * Class GetAffectedFilesQueryHandlerTest.
 *
 * @covers \Gitamine\Git\Handler\PostCheckout\GetAffectedFilesQueryHandler
 */
class GetAffectedFilesQueryHandlerTest extends TestCase
{
    public function testShouldGetFilesGivenOriginBranch(): void
    {
        $files = [$this->file('file.txt')];

        $postCheckout = new PostCheckoutMock();
        $postCheckout->mockGetAffectedBranches('master', 'develop');
        $postCheckout->mockGetFiles('feature', 'develop', $files);

        $handler = new GetAffectedFilesQueryHandler($postCheckout->mock());
        $result  = $handler(new GetAffectedFilesQuery('feature', ''));

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

        $handler = new GetAffectedFilesQueryHandler($postCheckout->mock());
        $result  = $handler(new GetAffectedFilesQuery('master', '', 'file2.txt'));

        self::assertEquals(
            [$files[1]],
            $result
        );
    }
}
