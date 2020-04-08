<?php

namespace App\Exceptions;

class InvalidDigit extends \Exception
{
    protected $message = 'Not a valid number';
}