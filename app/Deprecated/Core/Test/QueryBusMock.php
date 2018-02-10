<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Test;

use App\Prooph\QueryBus;
use Hamcrest\Matchers;
use Mockery;
use Mockery\MockInterface;

/**
 * Class QueryBusMock.
 */
class QueryBusMock
{
    /**
     * @var MockInterface
     */
    private $bus;

    public function __construct()
    {
        $this->bus = Mockery::mock(QueryBus::class);
    }

    /**
     * @return self
     */
    public static function create(): self
    {
        return new self();
    }

    /**
     * @return QueryBus
     */
    public function bus(): QueryBus
    {
        return $this->bus;
    }

    /**
     * @param        $query
     * @param string $return
     */
    public function shouldDispatch($query, string $return): void
    {
        $this->bus->shouldReceive('dispatch')
                  ->once()
                  ->with(Matchers::equalTo($query))
                  ->andReturn($return);
    }
}
