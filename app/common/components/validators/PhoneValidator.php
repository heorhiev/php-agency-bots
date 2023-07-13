<?php

namespace app\common\components;


class PhoneValidator extends Validator
{
    public function isValid($value): bool
    {
        return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }
}