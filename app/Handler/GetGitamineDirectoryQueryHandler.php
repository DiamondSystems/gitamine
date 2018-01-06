<?php

declare(strict_types=1);

namespace Gitamine\Handler;

use Gitamine\Infrastructure\GitamineConfig;
use Gitamine\Query\GetGitamineDirectoryQuery;

/**
 * Class GetGitamineDirectoryQueryHandler.
 */
class GetGitamineDirectoryQueryHandler
{
    /**
     * @var GitamineConfig
     */
    private $gitamine;

    /**
     * GetGitamineDirectoryQueryHandler constructor.
     *
     * @param GitamineConfig $gitamine
     */
    public function __construct(GitamineConfig $gitamine)
    {
        $this->gitamine = $gitamine;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @param GetGitamineDirectoryQuery $query
     *
     * @return string
     */
    public function __invoke(GetGitamineDirectoryQuery $query): string
    {
        return $this->gitamine->getGitamineFolder()->dir();
    }
}
