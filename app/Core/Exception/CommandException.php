<?php

declare(strict_types=1);

namespace Gitamine\Core\Exception;

use Gitamine\Core\Domain\Command;
use Throwable;

/**
 * Class CommandException.
 */
class CommandException extends InfrastructureException
{
    /**
     * CommandException constructor.
     *
     * @param Command        $command
     * @param null|Throwable $exception
     */
    public function __construct(Command $command, ?Throwable $exception = null)
    {
        parent::__construct(
            "Command '{$command->command()}' exited with status {$command->status()} ({$command->output()}",
            $exception
        );
    }
}
