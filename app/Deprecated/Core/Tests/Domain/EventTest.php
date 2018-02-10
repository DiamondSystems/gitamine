<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Tests\Domain;

use Gitamine\Deprecated\Core\Domain\Event;
use Gitamine\Deprecated\Core\Exception\InvalidEventException;
use PHPUnit\Framework\TestCase;

/**
 * Class EventTest.
 *
 * @coversNothing
 */
class EventTest extends TestCase
{
    public function testShouldWork(): void
    {
        $event = new Event('pre-commit');
        self::assertEquals('pre-commit', $event->event());
    }

    public function testShouldThrowInvalidEventException(): void
    {
        $this->expectException(InvalidEventException::class);
        new Event('asd');
    }
}
