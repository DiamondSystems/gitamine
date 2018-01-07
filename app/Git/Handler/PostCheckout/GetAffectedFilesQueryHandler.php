<?php

declare(strict_types=1);

namespace Gitamine\Git\Handler\PostCheckout;

use Generator;
use Gitamine\Git\Domain\Branch;
use Gitamine\Git\Infrastructure\PostCheckout;
use Gitamine\Git\Query\PostCheckout\GetAffectedFilesQuery;

/**
 * Class GetAffectedFilesQueryHandler.
 */
class GetAffectedFilesQueryHandler
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
     * @return string[]|Generator
     */
    public function __invoke(GetAffectedFilesQuery $query): Generator
    {
        [$source, $destiny] = $this->postCheckout->getAffectedBranches();

        if ($query->source()) {
            $source = new Branch($query->source());
        }

        $files = $this->postCheckout->getAffectedFiles($source, $destiny);

        foreach ($files as $file) {
            if (\preg_match('/' . $query->filter() . '/', $file->file())) {
                yield $file->file();
            }
        }
    }
}
