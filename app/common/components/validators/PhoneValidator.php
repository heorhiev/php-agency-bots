<?php

namespace app\common\components\validators;


class PhoneValidator extends Validator
{
    public function isValid($value): bool
    {
        $value = preg_replace('/[^0-9]/', '', $value);
        return (new TextValidator(['min' => 7, 'max' => 12]))->isValid($value);
    }
}