<?php

namespace App;

use App\Parser\AccountNumberParser;
use App\Parser\Factory\AccountNumberParserFactory;
use App\Parser\FileParser;
use App\Parser\DigitParser;

class OCR
{
    protected FileParser $fileParser;
    protected DigitParser $digitParser;
    protected array $accounts = [];

    public function __construct(FileParser $fileParser, DigitParser $digitParser)
    {
        $this->fileParser = $fileParser;
        $this->digitParser = $digitParser;
    }

    public function run(): OCR
    {
        foreach ($this->fileParser->getAccountNumbers() as $accountNumberLines) {
            $this->accounts[] = $this->processAccountNumber($accountNumberLines);
        }


        return $this;
    }

    protected function processAccountNumber(array $accountNumberLines): string
    {
        $parsedAccountNumber = '';
        foreach ($this->initNumberParser($accountNumberLines)->getDigits() as $number) {
            $parsedAccountNumber .= $this->digitParser->parse($number);
        }

        return $parsedAccountNumber;
    }

    protected function initNumberParser(array $lines): AccountNumberParser
    {
        return AccountNumberParserFactory::make()->parse(
            join("\n", $lines)
        );
    }

    public function getResult(): string
    {
        return join("\n", $this->accounts);
    }
}
