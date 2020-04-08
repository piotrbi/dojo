<?php

namespace App\Parser\Factory;

use App\Parser\DigitExploder;
use App\Parser\AccountNumberParser;
use App\Parser\Validator\AccountNumberLinesValidator;

class AccountNumberParserFactory
{
    public static function make(): AccountNumberParser
    {
        return new AccountNumberParser(
            new AccountNumberLinesValidator(),
            new DigitExploder()
        );
    }
}