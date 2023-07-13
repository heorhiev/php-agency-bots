<?php

namespace app\common\bots\vacancy;

use app\common\components\Validator;


class NameValidator extends Validator
{
    public $minLength = 5;
    public $minSpaces = 1;

    public function isValid($value): bool
    {
        return strlen($value) >= $this->minLength && substr_count($value, ' ') >= $this->minSpaces;
    }
}