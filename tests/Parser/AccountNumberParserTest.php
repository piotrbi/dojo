<?php

namespace App\Tests\Parser;

use App\Exceptions\InvalidAccountNumberFormat;
use App\Parser\AccountNumberParser;
use App\Parser\DigitExploder;
use App\Parser\Validator\AccountNumberLinesValidator;
use PHPStan\Testing\TestCase;

class AccountNumberParserTest extends TestCase
{
    public function testException()
    {
        $validatorMock = $this->getMockBuilder(AccountNumberLinesValidator::class)
            ->onlyMethods(['validate', 'getErrors'])
            ->getMock();

        $validatorMock->method('validate')->willReturn(false);
        $validatorMock->method('getErrors')->willReturn(['first error', 'second error']);

        $digitExploderMock = $this->getMockBuilder(DigitExploder::class)
            ->getMock();

        $this->expectException(InvalidAccountNumberFormat::class);
        $this->expectExceptionMessage('first error, second error');

        $parser = new AccountNumberParser($validatorMock, $digitExploderMock);
        $parser->parse('no matter what');
    }

    public function  testParse()
    {
        $validatorMock = $this->getMockBuilder(AccountNumberLinesValidator::class)
            ->onlyMethods(['validate', 'getErrors'])
            ->getMock();

        $validatorMock->method('validate')->willReturn(true);

        $digitExploderMock = $this->getMockBuilder(DigitExploder::class)
            ->onlyMethods(['parse', 'getDigits'])
            ->getMock();

        $digitExploderMock->method('parse')->willReturn($digitExploderMock);
        $digitExploderMock->method('getDigits')->willReturn([1,2,3]);

        $parser = new AccountNumberParser($validatorMock, $digitExploderMock);
        $parser->parse('no matter what');

        $this->assertIsArray($parser->getDigits());
        $this->assertEquals([1,2,3], $parser->getDigits());
    }
}