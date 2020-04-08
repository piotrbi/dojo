<?php

namespace App\Tests\Parser;

use App\Parser\FileParser;
use PHPStan\Testing\TestCase;

class FileParserTest extends TestCase
{
    public function testChunks()
    {
        $fileParser = $this->getMockBuilder(FileParser::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getLinesFromFile', 'validate'])
            ->getMock();

        $fileParser->method('getLinesFromFile')->willReturn(
            ["line1", "line2", "line3", "line4", "line5", "line6", "line7", "line8"]
        );

        $result = $fileParser->getAccountNumbers();

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertEquals(["line1", "line2", "line3", "line4"], $result[0]);
        $this->assertEquals(["line5", "line6", "line7", "line8"], $result[1]);
    }
}