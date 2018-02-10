<?php

declare(strict_types=1);

namespace Gitamine\Git\PreCommit\Test;

use Gitamine\Git\Common\Domain\File;
use Gitamine\Git\Common\Domain\FileStatus;
use Gitamine\Git\PreCommit\Infrastructure\PreCommit;
use Hamcrest\Matchers;
use Mockery;
use Mockery\MockInterface;

/**
 * Class GitMock.
 */
class PreCommitMock
{
    /**
     * @var MockInterface
     */
    private $postCheckout;

    public function __construct()
    {
        $this->postCheckout = Mockery::mock(PreCommit::class);
    }

    /**
     * @return MockInterface|PreCommit
     */
    public function mock(): PreCommit
    {
        return $this->postCheckout;
    }

    /**
     * @param string[] $return
     */
    public function mockGetFiles(array $return): void
    {
        $this->postCheckout->shouldReceive('getFiles')
                           ->once()
                        ->with(
                            Matchers::equalTo(new FileStatus(''))
                        )
                           ->andReturn(\array_map(function (string $file) {
                               return new File($file);
                           }, $return));
    }

    /**
     * @param string[] $return
     */
    public function mockGetStagedFiles(array $return): void
    {
        $this->postCheckout->shouldReceive('getStagedFiles')
                           ->once()
                        ->with(
                            Matchers::equalTo(new FileStatus(''))
                        )
                           ->andReturn(\array_map(function (string $file) {
                               return new File($file);
                           }, $return));
    }
}
