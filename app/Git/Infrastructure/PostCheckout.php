<?php
declare(strict_types=1);

namespace Gitamine\Git\Infrastructure;

use Gitamine\Git\Domain\Branch;

/**
 * Interface PostCheckout
 *
 * @package Gitamine\Git\Infrastructure
 */
interface PostCheckout
{
    /**
     * @return Branch[]
     */
    public function getAffectedBranches(): array;

    /**
     * @param Branch|null $source
     *
     * @return mixed
     */
    public function getAffectedFiles(?Branch $source = null);
}
