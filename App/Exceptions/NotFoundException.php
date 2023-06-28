<?php

namespace App\Exceptions;


class NotFoundException extends \Exception
{
    public $message = 'Not found';

    public function getExceptionCode(): int
    {
        return 404;
    }
}