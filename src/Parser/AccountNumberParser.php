<?php

namespace App\Parser;

use App\Exceptions\InvalidAccountNumberFormat;
use App\Parser\Validator\AccountNumberLinesValidator;

class AccountNumberParser
{
    protected AccountNumberLinesValidator $accountNumberLinesValidator;
    protected DigitExploder $digitExploder;

    public function __construct(AccountNumberLinesValidator $accountNumberLinesValidator, DigitExploder $digitExploder)
    {
        $this->accountNumberLinesValidator = $accountNumberLinesValidator;
        $this->digitExploder = $digitExploder;
    }

    /**
     * @param string $data
     * @return AccountNumberParser
     * @throws InvalidAccountNumberFormat
     */
    public function parse(string $data): AccountNumberParser
    {
        if (!$this->accountNumberLinesValidator->validate($data)) {
            throw new InvalidAccountNumberFormat(join(", ", $this->accountNumberLinesValidator->getErrors()));
        }

        $this->digitExploder->parse($data);

        return $this;
    }

    public function getDigits(): array
    {
        return $this->digitExploder->getDigits();
    }

}