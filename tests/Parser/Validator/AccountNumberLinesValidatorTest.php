<?php

namespace App\Tests\Parser\Validator;

use App\Parser\Validator\AccountNumberLinesValidator;
use PHPUnit\Framework\TestCase;

class AccountNumberLinesValidatorTest extends TestCase
{
    /**
     * @dataProvider validateProvider
     */
    public function testValidate($input, $expected)
    {
        $validator = new AccountNumberLinesValidator();

        $result = $validator->validate($input);

        $this->assertEquals($expected, $result);
    }

    public function validateProvider()
    {
        $wrong = <<<EOT
this
is
wrong
EOT;
        $ok = <<<EOT
line
second
third
forth
EOT;

        return [
            [$wrong, false],
            [$ok, true]
        ];
    }
}