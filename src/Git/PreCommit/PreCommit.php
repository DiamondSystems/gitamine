<?php

declare(strict_types=1);

namespace App\Git\PreCommit;

use App\Terminal;
use Gitamine\Git\Domain\File;
use Gitamine\Git\Domain\FileStatus;
use Gitamine\Git\Infrastructure\PreCommit as BasePreCommit;

/**
 * Class PreCommit.
 */
class PreCommit implements BasePreCommit
{
    /**
     * @var Terminal
     */
    private $terminal;

    public function __construct()
    {
        $this->terminal = new Terminal();
    }

    /**
     * @param FileStatus $status
     *
     * @return File[]
     */
    public function getFiles(FileStatus $status): array
    {
        $command = "git diff --name-only --diff-filter={$status->status()}";
        [$status, $output] = $this->terminal->run($command);

        $return = [];
        
        if (0 === $status) {
            $files = \explode("\n", $output);
            foreach ($files as $file) {
                $return[] = new File($file);
            }
        }

        return $return;
    }

    /**
     * @param FileStatus $status
     *
     * @return File[]
     */
    public function getStagedFiles(FileStatus $status): array
    {
        $command = "git diff --staged --name-only --diff-filter={$status->status()}";
        [$status, $output] = $this->terminal->run($command);

        $return = [];

        if (0 === $status) {
            $files = \explode("\n", $output);
            foreach ($files as $file) {
                $return[] = new File($file);
            }
        }

        return $return;
    }

    /**
     * @param FileStatus $status
     *
     * @return File[]
     */
    public function getNotStagedFiles(FileStatus $status): array
    {
        return \array_diff($this->getFiles($status), $this->getStagedFiles($status));
    }
}
