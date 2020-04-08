<?php

namespace App\Parser\Validator;

class AccountNumberLinesValidator
{
    const NUMBER_OF_NEW_LINES = 3;

    protected bool $isValid = false;
    protected array $errors = [];

    public function validate(string $data): bool
    {
        if (!$this->validateLineCount($data)) {
            $this->errors[] = 'Invalid number of rows.';
        }

        return !$this->hasErrors();
    }

    private function hasErrors(): bool
    {
        return !empty($this->errors);
    }


    public function getErrors(): array
    {
        return $this->errors;
    }

    protected function validateLineCount(string $data): bool
    {
        return substr_count($data, "\n") == self::NUMBER_OF_NEW_LINES;
    }

}