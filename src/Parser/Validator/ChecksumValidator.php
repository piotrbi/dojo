<?php

namespace App\Parser\Validator;

class ChecksumValidator
{
    public function validate(string $accountNumber): bool
    {
        $checksum = 0;
        for ($i = 8; $i >= 0; $i--) {
            $checksum += (9 - $i) * $accountNumber[$i];
        }
        return $checksum % 11 === 0;
    }
}