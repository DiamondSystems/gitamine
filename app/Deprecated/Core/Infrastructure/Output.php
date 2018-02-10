<?php

declare(strict_types=1);

namespace Gitamine\Deprecated\Core\Infrastructure;

/**
 * Interface ConsoleOutput.
 */
interface Output
{
    /**
     * @param string $message
     */
    public function print(string $message): void;

    /**
     * @param string $message
     */
    public function println(string $message): void;

    /**
     * @param string $message
     */
    public function printError(string $message): void;

    /**
     * @return int
     */
    public function getCurrentLine(): int;

    /**
     * @return int
     */
    public function getCurrentColumn(): int;

    /**
     * @param int $row
     * @param int $col
     */
    public function moveTo(int $row, int $col): void;

    public function clearLine(): void;
}
