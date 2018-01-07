<?php
declare(strict_types=1);

namespace Gitamine\Git\Test;

use Generator;
use Gitamine\Git\Domain\Branch;
use Gitamine\Git\Domain\File;
use Gitamine\Git\Infrastructure\PostCheckout;
use Hamcrest\Matchers;
use Mockery;
use Mockery\MockInterface;

/**
 * Class GitMock
 *
 * @package Gitamine\Git\Test
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
    public function postCheckout(): PostCheckout
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
    public function mockGetAffectedFiles(string $source, string $destiny, array $files): void
    {
        $this->postCheckout->shouldReceive('getAffectedFiles')
                           ->once()
                           ->with(
                               Matchers::equalTo(new Branch($source)),
                               Matchers::equalTo(new Branch($destiny))
                           )
                           ->andReturn($this->builFiles($files));
    }

    /**
     * @param array $list
     *
     * @return Generator
     */
    private function builFiles(array $list): Generator
    {
        foreach ($list as $element) {
            yield new File($element);
        }
    }
}
