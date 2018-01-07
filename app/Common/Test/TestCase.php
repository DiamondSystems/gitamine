<?php

declare(strict_types=1);

namespace Gitamine\Common\Test;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase as PhpunitTestCase;

/**
 * Class TestCase.
 *
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 *
 * @coversNothing
 */
class TestCase extends PhpunitTestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @param string $name
     *
     * @return string
     */
    protected function file(string $name): string
    {
        return \realpath(__DIR__ . '/../assets/' . $name);
    }
}
