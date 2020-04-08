<?php

namespace App;

use App\Parser\DigitParser;
use App\Parser\FileParser;
use App\Parser\Validator\ChecksumValidator;

class OCRValidated extends OCR
{
    protected ChecksumValidator $validator;
    protected array $validAccountNumbers = [];
    protected array $invalidAccountNumbers = [];

    public function __construct(FileParser $fileParser, DigitParser $digitParser, ChecksumValidator $validator)
    {
        parent::__construct($fileParser, $digitParser);
        $this->validator = $validator;
    }

    public function run(): OCRValidated
    {
        parent::run();
        return  $this->validateAll();
    }

    protected function validateAll(): OCRValidated
    {
        foreach ($this->accounts as $account) {
            $this->validateAccountNumber($account);
        }

        return $this;
    }

    protected function validateAccountNumber(string $account): void
    {
        if ($this->validator->validate($account)) {
            $this->validAccountNumbers[] = $account;
            return;
        }

        $this->invalidAccountNumbers[] = $account;
    }

    public function getValidAccountNumbers(): string
    {
        return join("\n", $this->validAccountNumbers);
    }

    public function getInvalidAccountNumbers(): string
    {
        return join("\n", $this->invalidAccountNumbers);
    }
}