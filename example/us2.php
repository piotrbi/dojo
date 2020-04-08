<?php

require __DIR__ . '/../vendor/autoload.php';

$ocr = new \App\OCRValidated(
    new \App\Parser\FileParser(__DIR__ . '/data.txt'),
    new \App\Parser\DigitParser(new \App\Hasher()),
    new \App\Parser\Validator\ChecksumValidator()
);

$ocr->run();
echo "Valid account numbers: \n";
echo $ocr->getValidAccountNumbers();
echo "\nInvalid account numbers: \n";
echo $ocr->getInvalidAccountNumbers() . "\n";
