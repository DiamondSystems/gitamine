<?php

declare(strict_types=1);

namespace Gitamine\Git\Query\PreCommit;

/**
 * Class GetAffectedFilesQuery.
 */
class GetAffectedFilesQuery
{
    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $filter;
    
    /**
     * GetAffectedFilesQuery constructor.
     *
     * @param string $status
     * @param string $filter
     */
    public function __construct(string $status, string $filter = '.*')
    {
        $this->status = $status;
        $this->filter = $filter;
    }

    /**
     * @return string
     */
    public function status(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function filter(): string
    {
        return $this->filter;
    }
}
