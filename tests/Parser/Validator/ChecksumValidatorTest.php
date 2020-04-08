<?php

namespace App\Tests\Parser\Validator;

use App\Parser\Validator\ChecksumValidator;
use PHPUnit\Framework\TestCase;

class ChecksumValidatorTest extends TestCase
{
    /**
     * @dataProvider validateProvider
     */
    public function testValidate($number, $expected)
    {
        $validator = new ChecksumValidator();

        $result = $validator->validate($number);

        $this->assertEquals($expected, $result);
    }

    public function validateProvider()
    {
        return [
            ["000000051", true],
            ["555555555", false],
            ["000000000", true]
        ];
    }
}