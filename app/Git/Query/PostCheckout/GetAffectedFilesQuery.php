<?php

declare(strict_types=1);

namespace Gitamine\Git\Query\PostCheckout;

/**
 * Class GetAffectedFilesQuery.
 */
class GetAffectedFilesQuery
{
    /**
     * @var null|string
     */
    private $source;

    /**
     * @var string
     */
    private $filter;

    /**
     * GetAffectedFilesQuery constructor.
     *
     * @param null|string $source
     * @param string      $filter
     */
    public function __construct(?string $source = null, string $filter = '.*')
    {
        $this->source = $source;
        $this->filter = $filter;
    }

    /**
     * @return null|string
     */
    public function source(): ?string
    {
        return $this->source;
    }

    /**
     * @return string
     */
    public function filter(): string
    {
        return $this->filter;
    }
}
