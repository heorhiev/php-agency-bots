<?php

namespace app\common\components\exceptions;


class NotFoundException extends \Exception
{
    public $message = 'Not found';

    public function getExceptionCode(): int
    {
        return 404;
    }
}