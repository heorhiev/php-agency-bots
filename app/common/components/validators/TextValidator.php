<?php

namespace app\common\components\validators;

use app\common\components\validators\Validator;


class TextValidator extends Validator
{
    public $min = 5;
    public $max = 50;

    public function isValid($value): bool
    {
        $length = mb_strlen($value);
        return $this->min <= $length && $this->max >= $length;
    }
}