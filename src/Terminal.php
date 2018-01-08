<?php
declare(strict_types=1);

namespace App;

/**
 * Class Terminal
 * @package App
 */
class Terminal
{
    /**
     * @var string
     */
    private $dir;

    /**
     * Terminal constructor.
     *
     * @param string|null $dir
     */
    public function __construct(string $dir = null)
    {
        $this->dir = $dir ?? getcwd();
    }

    /**
     * Returns an array with the status in the first position and the output in the second
     *
     * @param string $command
     * @param bool   $outputWithErrors
     *
     * @return array
     */
    public function run(string $command, bool $outputWithErrors = true): array
    {
        $pipe   = $outputWithErrors ? '2 > &1' : '2 > /dev/null';
        $status = 0;
        $output = [];

        exec("cd {$this->dir} ; {$command} {$pipe}", $output, $status);

        return [
            $status,
            implode("\n", $output)
        ];
    }
}
