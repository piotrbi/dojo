<?php

namespace App\Parser;

class DigitExploder
{
    const STRING_LENGTH = 3;
    const NUMBERS_IN_LINE = 9;
    const LINES_COUNT = 4;

    protected array $digits = [];

    public function parse(string $data): DigitExploder
    {
        for ($offset = 0; $offset < self::NUMBERS_IN_LINE; $offset++) {
            $this->digits[] = $this->doWork($data, $offset);
        }

        return $this;
    }

    protected function doWork(string $data, int $offset): string
    {
        $lines = $this->getLines($data);
        $return = [];

        for ($i = 0; $i < self::LINES_COUNT; $i++) {
            $return[] = substr($lines[$i], $offset * self::STRING_LENGTH, self::STRING_LENGTH);
        }

        return join("\n", $return);
    }

    protected function getLines(string $data): array
    {
        return explode("\n", $data);
    }

    public function getDigits(): array
    {
        return $this->digits;
    }

}