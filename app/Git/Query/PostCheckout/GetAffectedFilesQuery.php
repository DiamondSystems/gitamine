<?php

declare(strict_types=1);

namespace Gitamine\Git\Query\PostCheckout;

/**
 * Class GetAffectedFilesQuery.
 */
final class GetAffectedFilesQuery
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
     * @var string
     */
    private $status;

    /**
     * GetAffectedFilesQuery constructor.
     *
     * @param string      $source
     * @param string      $status
     * @param null|string $filter
     */
    public function __construct(
        string $source,
        string $status,
        string $filter = null
    ) {
        $this->source = $source;
        $this->status = $status;
        $this->filter = $filter ?? '.*';
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

    /**
     * @return string
     */
    public function status(): string
    {
        return $this->status;
    }
}
