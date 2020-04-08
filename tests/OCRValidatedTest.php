<?php

namespace App\Tests;

use App\Hasher;
use App\OCRValidated;
use App\Parser\DigitParser;
use App\Parser\FileParser;
use App\Parser\Validator\ChecksumValidator;
use PHPStan\Testing\TestCase;

class OCRValidatedTest extends TestCase
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

        $line5 = "                           ";
        $line6 = "|_||_||_||_||_||_||_||_||_|";
        $line7 = "  |  |  |  |  |  |  |  |  |";
        $line8 = "";

        $file->method('getAccountNumbers')->willReturn([
            [$line1, $line2, $line3, $line4],
            [$line5, $line6, $line7, $line8]
        ]);

        $ocr = new OCRValidated($file, new DigitParser(new Hasher()), new ChecksumValidator());
        $ocr->run();

        $result = $ocr->getResult();
        $valid = $ocr->getValidAccountNumbers();
        $invalid = $ocr->getInvalidAccountNumbers();

        $this->assertEquals("000000051\n444444444", $result);
        $this->assertEquals('000000051', $valid);
        $this->assertEquals('444444444', $invalid);
    }
}