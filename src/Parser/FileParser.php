<?php

namespace App\Parser;

use App\Exceptions\FileNotExists;

class FileParser
{
    const LINES_PER_ACCOUNT = 4;

    protected string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
        $this->validate();
    }

    public function getAccountNumbers(): array
    {
        return array_chunk(
            $this->getLinesFromFile(),
            self::LINES_PER_ACCOUNT
        );
    }

    protected function getLinesFromFile(): array
    {
        return explode("\n", file_get_contents($this->path));
    }

    protected function validate(): void
    {
        if (!file_exists($this->path)) {
            throw new FileNotExists();
        }
    }
}