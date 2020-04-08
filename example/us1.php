<?php

require __DIR__ . '/../vendor/autoload.php';

$ocr = new \App\OCR(
    new \App\Parser\FileParser(__DIR__ . '/data.txt'),
    new \App\Parser\DigitParser(new \App\Hasher())
);

echo "Parsed account numbers:\n";
echo ($ocr->run()->getResult()) . "\n";