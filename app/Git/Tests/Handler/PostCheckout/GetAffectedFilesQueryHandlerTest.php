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
    public function testShouldGetAffectedBranchesGivenOriginBranch(): void
    {
        $files = [$this->file('file.txt')];

        $postCheckout = new PostCheckoutMock();
        $postCheckout->mockGetAffectedBranches('master', 'develop');
        $postCheckout->mockGetAffectedFiles('feature', 'develop', $files);

        $handler = new GetAffectedFilesQueryHandler($postCheckout->postCheckout());
        $result  = $handler(new GetAffectedFilesQuery('feature'));

        self::assertEquals(
            $files,
            \iterator_to_array($result)
        );
    }

    public function testShouldGetAffectedBranchesWithoutGivenOriginBranch(): void
    {
        $files = [$this->file('file.txt')];

        $postCheckout = new PostCheckoutMock();
        $postCheckout->mockGetAffectedBranches('master', 'develop');
        $postCheckout->mockGetAffectedFiles('master', 'develop', $files);

        $handler = new GetAffectedFilesQueryHandler($postCheckout->postCheckout());
        $result  = $handler(new GetAffectedFilesQuery());

        self::assertEquals(
            $files,
            \iterator_to_array($result)
        );
    }

    public function testShouldGetAffectedBranchesWithFilters(): void
    {
        $files = [$this->file('file.txt'), $this->file('file2.txt')];

        $postCheckout = new PostCheckoutMock();
        $postCheckout->mockGetAffectedBranches('master', 'develop');
        $postCheckout->mockGetAffectedFiles('master', 'develop', $files);

        $handler = new GetAffectedFilesQueryHandler($postCheckout->postCheckout());
        $result  = $handler(new GetAffectedFilesQuery(null, 'file2.txt'));

        self::assertEquals(
            [$files[1]],
            \iterator_to_array($result)
        );
    }
}
