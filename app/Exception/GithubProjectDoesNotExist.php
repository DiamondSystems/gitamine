<?php

declare(strict_types=1);

namespace Gitamine\Exception;

use Exception;
use Throwable;

/**
 * Class GithubProjectDoesNotExist.
 */
class GithubProjectDoesNotExist extends Exception
{
    /**
     * GithubProjectDoesNotExist constructor.
     *
     * @param string         $plugin
     * @param Throwable|null $previous
     */
    public function __construct(string $plugin, Throwable $previous = null)
    {
        parent::__construct(\sprintf('Plugin %s does not exist.', $plugin), 1, $previous);
    }
}
