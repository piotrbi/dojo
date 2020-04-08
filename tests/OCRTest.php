<?php

namespace App\Tests;

use App\Hasher;
use App\OCR;
use App\Parser\DigitParser;
use App\Parser\FileParser;
use PHPStan\Testing\TestCase;

class OCRTest extends TestCase
{
    public function testRun()
    {
        $file = $this->getMockBuilder(FileParser::class)
            ->onlyMethods(['getAccountNumbers'])
            ->disableOriginalConstructor()
            ->getMock();

        $line1 = " _  _  _  _  _  _  _  _    ";
        $line2 = "| || || || || || || ||_   |";
        $line3 = "|_||_||_||_||_||_||_| _|  |";
        $line4 = "";
        
        $file->method('getAccountNumbers')->willReturn([[$line1, $line2, $line3, $line4]]);

        $ocr = new OCR($file, new DigitParser(new Hasher()));
        $ocr->run();

        $result = $ocr->getResult();

        $this->assertEquals('000000051', $result);
    }
}