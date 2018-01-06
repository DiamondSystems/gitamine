<?php

declare(strict_types=1);

namespace Gitamine\Tests\Domain;

use Gitamine\Domain\Event;
use Gitamine\Exception\InvalidEventException;
use PHPUnit\Framework\TestCase;

/**
 * Class EventTest.
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
