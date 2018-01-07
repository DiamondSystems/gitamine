<?php

declare(strict_types=1);

namespace Gitamine\Git\Query\PostCheckout;

/**
 * Class GetAffectedFilesQuery
 *
 * @package Gitamine\Git\PostCheckout\Query
 */
class GetAffectedFilesQuery
{
    /**
     * @var null|string
     */
    private $source;

    /**
     * GetAffectedFilesQuery constructor.
     *
     * @param null|string $source
     */
    public function __construct(?string $source = null)
    {
        $this->source = $source;
    }

    /**
     * @return null|string
     */
    public function source(): ?string
    {
        return $this->source;
    }
}
