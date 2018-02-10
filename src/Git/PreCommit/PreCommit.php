<?php

declare(strict_types=1);

namespace App\Git\PreCommit;

use Gitamine\Core\Domain\Command;
use Gitamine\Git\Common\Domain\File;
use Gitamine\Git\Common\Domain\FileStatus;
use Gitamine\Git\PreCommit\Infrastructure\PreCommit as BasePreCommit;

/**
 * Class PreCommit.
 */
class PreCommit implements BasePreCommit
{
    /**
     * @param FileStatus $status
     *
     * @return File[]
     */
    public function getFiles(FileStatus $status): array
    {
        return \array_unique(\array_merge($this->getFiles($status), $this->getStagedFiles($status)));
    }

    /**
     * @param FileStatus $status
     *
     * @return File[]
     */
    public function getStagedFiles(FileStatus $status): array
    {
        Command::checkExecutable('git status');
        $command = new Command("git diff --staged --name-only --diff-filter={$status->status()}");
        $command->run();
        $output = $command->output();

        $return = [];

        $files = \explode("\n", $output);
        foreach ($files as $file) {
            if (!empty($file)) {
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
        Command::checkExecutable('git status');
        $command = new Command("git diff --name-only --diff-filter={$status->status()}");
        $command->run();
        $output = $command->output();
        $return = [];

        if (0 === $status) {
            $files = \explode("\n", $output);

            foreach ($files as $file) {
                $return[] = new File($file);
            }
        }

        return $return;
    }
}
