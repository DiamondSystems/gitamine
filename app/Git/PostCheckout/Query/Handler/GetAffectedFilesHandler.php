<?php

declare(strict_types=1);

namespace Gitamine\Git\PostCheckout\Query\Handler;

use Gitamine\Deprecated\Core\Domain\RegExp;
use Gitamine\Git\Common\Domain\Branch;
use Gitamine\Git\Common\Domain\FileStatus;
use Gitamine\Git\PostCheckout\Infrastructure\PostCheckout;
use Gitamine\Git\PostCheckout\Query\GetAffectedFiles;

/**
 * Class GetAffectedFilesHandler
 */
final class GetAffectedFilesHandler
{
    /**
     * @var PostCheckout
     */
    private $postCheckout;

    /**
     * GetAffectedFilesQueryHandler constructor.
     *
     * @param PostCheckout $postCheckout
     */
    public function __construct(PostCheckout $postCheckout)
    {
        $this->postCheckout = $postCheckout;
    }

    /**
     * @param GetAffectedFiles $query
     *
     * @return string[]
     */
    public function __invoke(GetAffectedFiles $query): array
    {
        $branches = $this->postCheckout->getAffectedBranches();

        $return = [];

        if (count($branches) === 2) {
            [$source, $destiny] = $branches;

            $regExp = new RegExp($query->filter());

            if ($query->source()) {
                $source = new Branch($query->source());
            }

            $files = $this->postCheckout->getFiles($source, $destiny, new FileStatus($query->status()));

            foreach ($files as $file) {
                if ($file->match($regExp)) {
                    $return[] = $file->file();
                }
            }
        }

        return $return;
    }
}
