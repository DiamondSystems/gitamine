<?php

declare(strict_types=1);

namespace Gitamine\Git\Handler\PostCheckout;

use Gitamine\Domain\RegExp;
use Gitamine\Git\Domain\Branch;
use Gitamine\Git\Domain\FileStatus;
use Gitamine\Git\Infrastructure\PostCheckout;
use Gitamine\Git\Query\PostCheckout\GetAffectedFilesQuery;

/**
 * Class GetAffectedFilesQueryHandler.
 */
final class GetAffectedFilesQueryHandler
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
     * @param GetAffectedFilesQuery $query
     *
     * @return string[]
     */
    public function __invoke(GetAffectedFilesQuery $query): array
    {
        [$source, $destiny] = $this->postCheckout->getAffectedBranches();
        $regExp = new RegExp($query->filter());

        if ($query->source()) {
            $source = new Branch($query->source());
        }

        $files = $this->postCheckout->getFiles($source, $destiny, new FileStatus($query->status()));

        $return = [];

        foreach ($files as $file) {
            if ($file->match($regExp)) {
                $return[] = $file->file();
            }
        }

        return $return;
    }
}
