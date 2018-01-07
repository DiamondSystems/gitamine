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
        $postCheckout->mockGetAffectedFiles('master', 'develop', $files);

        $handler = new GetAffectedFilesQueryHandler($postCheckout->postCheckout());
        $result  = $handler(new GetAffectedFilesQuery('master'));

        self::assertEquals(
            $files,
            \iterator_to_array($result)
        );
    }
}
