<?php

namespace App\Tests\Parser;

use App\Hasher;
use PHPUnit\Framework\TestCase;

class HasherTest extends TestCase
{
    public function testHasher()
    {
        $str = 'some string';
        $hash = md5($str);
        $hasher = new Hasher();

        $result = $hasher->hash($str);

        $this->assertEquals($hash, $result);
    }
}