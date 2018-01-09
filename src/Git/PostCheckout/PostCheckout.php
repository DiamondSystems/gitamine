<?php

declare(strict_types=1);

namespace App\Git\PostCheckout;

use App\Terminal;
use Gitamine\Git\Domain\Branch;
use Gitamine\Git\Domain\File;
use Gitamine\Git\Domain\FileStatus;
use Gitamine\Git\Infrastructure\PostCheckout as BasePostCheckout;

/**
 * Class PostCheckout.
 */
class PostCheckout implements BasePostCheckout
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
     * @return Branch[]
     */
    public function getAffectedBranches(): array
    {
        $command = "git reflog | awk 'NR==1{ print $6 \"\n\" $8; exit }'";

        [$status, $output] = $this->terminal->run($command);

        if (0 === $status) {
            [$source, $destination] = \explode(PHP_EOL, $output);

            return [
                new Branch($source),
                new Branch($destination)
            ];
        }

        return [];
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
        $command = "git diff --name-only --diff-filter={$status->status()} {$source->name()}..{$destiny->name()}";

        [$status, $output] = $this->terminal->run($command);

        $return = [];

        if (0 === $status) {
            $files = \explode("\n", $output);
            foreach ($files as $file) {
                if (!empty($file)) {
                    $return[] = new File($file);
                }
            }
        }

        return $return;
    }
}
