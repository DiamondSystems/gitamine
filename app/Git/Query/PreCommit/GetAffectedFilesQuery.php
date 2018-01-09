<?php
declare(strict_types=1);

namespace Gitamine\Git\Query\PreCommit;

/**
 * Class GetAffectedFilesQuery
 * @package Gitamine\Git\Query\PreCommit
 */
class GetAffectedFilesQuery
{
    /**
     * @var string
     */
    private $status;

    /**
     * GetAffectedFilesQuery constructor.
     *
     * @param string $status
     */
    public function __construct(string $status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function status(): string
    {
        return $this->status;
    }
}
