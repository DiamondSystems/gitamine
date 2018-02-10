<?php

declare(strict_types=1);

namespace Gitamine\Git\PostCheckout\Test;

use Gitamine\Git\Common\Domain\Branch;
use Gitamine\Git\Common\Domain\File;
use Gitamine\Git\Common\Domain\FileStatus;
use Gitamine\Git\PostCheckout\Infrastructure\PostCheckout;
use Hamcrest\Matchers;
use Mockery;
use Mockery\MockInterface;

/**
 * Class GitMock.
 */
class PostCheckoutMock
{
    /**
     * @var MockInterface
     */
    private $postCheckout;

    public function __construct()
    {
        $this->postCheckout = Mockery::mock(PostCheckout::class);
    }

    /**
     * @return MockInterface|PostCheckout
     */
    public function mock(): PostCheckout
    {
        return $this->postCheckout;
    }

    /**
     * @param string $source
     * @param string $destiny
     */
    public function mockGetAffectedBranches(string $source, string $destiny): void
    {
        $this->postCheckout->shouldReceive('getAffectedBranches')
                           ->once()
                           ->withNoArgs()
                           ->andReturn([new Branch($source), new Branch($destiny)]);
    }

    /**
     * @param string   $source
     * @param string   $destiny
     * @param string[] $files
     */
    public function mockGetFiles(string $source, string $destiny, array $files): void
    {
        $this->postCheckout->shouldReceive('getFiles')
                           ->once()
                        ->with(
                            Matchers::equalTo(new Branch($source)),
                            Matchers::equalTo(new Branch($destiny)),
                            Matchers::equalTo(new FileStatus(''))
                        )
                           ->andReturn(\array_map(function (string $file) {
                               return new File($file);
                           }, $files));
    }
}
