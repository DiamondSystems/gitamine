<?php
declare(strict_types=1);

namespace App\Git\PostCheckout;

use App\Terminal;
use Generator;
use Gitamine\Git\Domain\Branch;
use Gitamine\Git\Domain\File;
use Gitamine\Git\Infrastructure\PostCheckout as BasePostCheckout;

/**
 * Class PostCheckout
 * @package App\Git\PostCheckout
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

        if ($status === 0) {
            [$source, $destination] = explode(PHP_EOL, $output);
            return [
                new Branch($source),
                new Branch($destination)
            ];
        }

        return [];
    }

    /**
     * @param Branch $source
     * @param Branch $destiny
     *
     * @param bool   $added
     * @param bool   $modified
     * @param bool   $deleted
     *
     * @return File[]|Generator
     */
    public function getFiles(
        Branch $source,
        Branch $destiny,
        bool $added = true,
        bool $modified = true,
        bool $deleted = false
    ): Generator {
        $filter  = '';
        $filter  .= $added ? 'A' : '';
        $filter  .= $modified ? 'M' : '';
        $filter  .= $deleted ? 'D' : '';

        $command = "git diff --name-only --diff-filter={$filter} {$source->name()}..{$destiny->name()}";

        [$status, $output] = $this->terminal->run($command);

        if ($status === 0) {
            $files = explode("\n", $output);
            foreach ($files as $file) {
                yield new File($file);
            }
        }
    }

}
