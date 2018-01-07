<?php

declare(strict_types=1);

namespace Gitamine\Git\Domain;

use Gitamine\Git\Exception\InvalidFileException;

/**
 * Class Directory.
 */
class File
{
    /**
     * @var string
     */
    private $file;

    /**
     * File constructor.
     *
     * @param string $file
     */
    public function __construct(string $file)
    {
        $this->file = $file;

        if (!\is_file($file)) {
            throw new InvalidFileException($this);
        }
    }

    /**
     * @return string
     */
    public function file(): string
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function filename(): string
    {
        return \basename($this->file());
    }
}
