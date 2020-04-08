<?php

namespace App;

class Hasher
{
    public function hash(string $data): string
    {
        return md5($data);
    }
}