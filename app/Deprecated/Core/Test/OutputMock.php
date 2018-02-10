<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Test;

use Gitamine\Deprecated\Core\Infrastructure\Output;
use Mockery;
use Mockery\MockInterface;

/**
 * Class OutputMock.
 */
class OutputMock
{
    /**
     * @var MockInterface
     */
    private $output;

    public function __construct()
    {
        $this->output = Mockery::spy(Output::class);
    }

    /**
     * @return Output
     */
    public function output(): Output
    {
        return $this->output;
    }

    /**
     * @return self
     */
    public static function create(): self
    {
        return new self();
    }
}
