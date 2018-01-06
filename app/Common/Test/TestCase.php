<?php

declare(strict_types=1);

namespace Gitamine\Common\Test;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase as PhpunitTestCase;

/**
 * Class TestCase.
 */
class TestCase extends PhpunitTestCase
{
    use MockeryPHPUnitIntegration;
}
