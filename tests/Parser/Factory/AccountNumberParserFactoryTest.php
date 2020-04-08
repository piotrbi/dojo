<?php

namespace App\Tests\Parser\Factory;

use App\Parser\AccountNumberParser;
use App\Parser\Factory\AccountNumberParserFactory;
use PHPUnit\Framework\TestCase;

class AccountNumberParserFactoryTest extends TestCase
{
    public function testMake()
    {
        $instance = AccountNumberParserFactory::make();

        $this->assertInstanceOf(AccountNumberParser::class, $instance);
    }
}