<?php

declare(strict_types=1);

namespace Gitamine\Git\Branch\Test;

use Gitamine\Git\Branch\Infrastructure\Branch;
use Gitamine\Git\Common\Domain\Branch as BranchDomain;
use Mockery;
use Mockery\MockInterface;

/**
 * Class BranchMock.
 */
class BranchMock
{
    /**
     * @var MockInterface
     */
    private $mock;

    public function __construct()
    {
        $this->mock = Mockery::mock(Branch::class);
    }

    /**
     * @return MockInterface|Branch
     */
    public function mock(): Branch
    {
        return $this->mock;
    }

    /**
     * @param string $return
     */
    public function mockGetCurrentBranch(string $return): void
    {
        $this->mock->shouldReceive('getCurrentBranch')
                   ->once()
                   ->with()
                   ->andReturn(new BranchDomain($return));
    }
}
