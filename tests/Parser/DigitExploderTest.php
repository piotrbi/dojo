<?php

namespace App\Tests\Parser;

use App\Parser\DigitExploder;
use PHPUnit\Framework\TestCase;

class DigitExploderTest extends TestCase
{
    public function testParse()
    {
        $data = <<<EOT
    _  _     _  _  _  _  _ 
  | _| _||_||_ |_   ||_||_|
  ||_  _|  | _||_|  ||_| _|

EOT;

        $exploder = new DigitExploder();
        $result = $exploder->parse($data);

        $this->assertInstanceOf(DigitExploder::class, $result);
        $this->assertIsArray($result->getDigits());
        $this->assertCount(9, $result->getDigits());
        $this->assertEquals(3, DigitExploder::STRING_LENGTH);
        $this->assertEquals(4, DigitExploder::LINES_COUNT);
        $this->assertEquals(9, DigitExploder::NUMBERS_IN_LINE);
    }
}