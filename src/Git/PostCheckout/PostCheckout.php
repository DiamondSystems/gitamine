<?php

declare(strict_types=1);

namespace App\Git\PostCheckout;

use Gitamine\Core\Domain\Command;
use Gitamine\Core\Exception\InfrastructureException;
use Gitamine\Git\Common\Domain\Branch;
use Gitamine\Git\Common\Domain\File;
use Gitamine\Git\Common\Domain\FileStatus;
use Gitamine\Git\PostCheckout\Infrastructure\PostCheckout as BasePostCheckout;

/**
 * Class PostCheckout.
 */
class PostCheckout implements BasePostCheckout
{
    /**
     * @return Branch[]
     */
    public function getAffectedBranches(): array
    {
        Command::checkExecutable('git status');
        $command = new Command("git reflog | awk 'NR==1{ print $6 \"\\n\" $8; exit }' ");
        $command->run();

        if ($command->lines() !== 2) {
            throw new InfrastructureException('Cannot retrieve affected branches');
        }

        $output = $command->output();

        [$source, $destination] = \explode(PHP_EOL, $output);

        return [
            new Branch($source),
            new Branch($destination)
        ];
    }

    /**
     * @param Branch     $source
     * @param Branch     $destiny
     * @param FileStatus $status
     *
     * @return File[]
     */
    public function getFiles(Branch $source, Branch $destiny, FileStatus $status): array
    {
        Command::checkExecutable('git status');

        $command = new Command(
            "git diff --name-only --diff-filter={$status->status()} {$source->name()}..{$destiny->name()}"
        );

        $command->run();

        $return = [];
        $files  = \explode("\n", $command->output());
        foreach ($files as $file) {
            $return[] = new File($file);
        }

        return $return;
    }
}
