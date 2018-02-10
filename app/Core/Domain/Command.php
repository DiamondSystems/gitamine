<?php

declare(strict_types=1);

namespace Gitamine\Core\Domain;

use App\Terminal;
use Gitamine\Core\Exception\CommandException;

/**
 * Class Command.
 */
class Command
{
    /**
     * @var Terminal
     */
    private $terminal;

    /**
     * @var string
     */
    private $command;

    /**
     * @var int
     */
    private $status;

    /**
     * @var string
     */
    private $output;

    /**
     * Command constructor.
     *
     * @param string $command
     */
    public function __construct(string $command)
    {
        $this->terminal = new Terminal();
        $this->command  = $command;
    }

    public function run(): void
    {
        [$this->status, $this->output] = $this->terminal->run($this->command);
        $this->checkStatus();
        $this->output = rtrim($this->output, "\n");
    }

    public function checkStatus(): void
    {
        if ($this->status !== 0) {
            throw new CommandException($this);
        }
    }

    /**
     * @return string
     */
    public function command(): string
    {
        return $this->command;
    }

    /**
     * @return int
     */
    public function status(): int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function output(): string
    {
        return $this->output;
    }

    /**
     * @return int
     */
    public function lines(): int
    {
        return substr_count($this->output, "\n");
    }

    /**
     * @param string $command
     */
    public static function checkExecutable(string $command): void
    {
        $test = new Command($command);
        $test->run();
    }
}
