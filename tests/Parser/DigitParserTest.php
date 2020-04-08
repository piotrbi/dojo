<?php

namespace App\Tests\Parser;

use App\Exceptions\InvalidDigit;
use App\Hasher;
use App\Parser\DigitParser;
use PHPUnit\Framework\TestCase;

class DigitParserTest extends TestCase
{
    /**
     * @dataProvider parseProvider
     */
    public function testParse($hash, $expected)
    {
        $mock = $this->getMockBuilder(Hasher::class)
            ->onlyMethods(['hash'])
            ->getMock();

        $mock->method('hash')->willReturn($hash);

        $parser = new DigitParser($mock);
        $result = $parser->parse('not important, result is mocked');

        $this->assertEquals($expected, $result);
    }

    public function testUnknownHash()
    {
        $this->expectException(InvalidDigit::class);

        $parser = new DigitParser(new Hasher());
        $parser->parse('lets parse it');
    }


    public function parseProvider()
    {
        return [
            ['f3ca545ae7abbe13510466244d1195ad', 0],
            ['ee2983a9f915fc74b82653f452da2be3', 1],
            ['c67418b70686a51ecb2bb76714d31b50', 2],
            ['4eb1c5cb3e9e52101b4976270b87b20c', 3],
            ['03d4b60a63d4d0f97cf99c974b9443b0', 4],
            ['2eac52162d5c29b7c84fed553a0e0cd8', 5],
            ['129e4040a864bfe463dc71451fcff42f', 6],
            ['3049beed9c549c25554cb926fc9e14ad', 7],
            ['d264ba042db693bcb30be689b647945a', 8],
            ['9d5c95e8c2ab898637177e803a9e5b29', 9]
        ];
    }

}