<?php

namespace App\Parser;

use App\Exceptions\InvalidDigit;
use App\Hasher;

class DigitParser
{
    protected array $digits = [
        'f3ca545ae7abbe13510466244d1195ad' => 0,
        'ee2983a9f915fc74b82653f452da2be3' => 1,
        'c67418b70686a51ecb2bb76714d31b50' => 2,
        '4eb1c5cb3e9e52101b4976270b87b20c' => 3,
        '03d4b60a63d4d0f97cf99c974b9443b0' => 4,
        '2eac52162d5c29b7c84fed553a0e0cd8' => 5,
        '129e4040a864bfe463dc71451fcff42f' => 6,
        '3049beed9c549c25554cb926fc9e14ad' => 7,
        'd264ba042db693bcb30be689b647945a' => 8,
        '9d5c95e8c2ab898637177e803a9e5b29' => 9,
    ];

    private Hasher $hasher;

    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @param string $data
     * @return int
     * @throws InvalidDigit
     */
    public function parse(string $data): int
    {
        $hash = $this->hasher->hash($data);

        if(!array_key_exists($hash, $this->digits)){
            throw new InvalidDigit();
        }

        return $this->digits[$hash];
    }
}
