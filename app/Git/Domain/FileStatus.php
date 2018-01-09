<?php
declare(strict_types=1);

namespace Gitamine\Git\Domain;

use Gitamine\Git\Exception\InvalidFileStatusException;

/**
 * Class FileStatus
 * @package Gitamine\Git\Domain
 */
class FileStatus
{
    /**
     * @var string
     */
    private $status;

    /**
     * FileStatus constructor.
     *
     * @param string $status
     */
    public function __construct(string $status)
    {
        $this->status = $status;

        if (!preg_match('/^[AMD]*$/', $status)) {
            throw new InvalidFileStatusException($this);
        }
    }

    /**
     * @return string
     */
    public function status(): string
    {
        return $this->status;
    }

}
