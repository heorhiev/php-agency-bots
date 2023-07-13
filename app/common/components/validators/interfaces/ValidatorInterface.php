<?php

namespace app\common\components\validators\interfaces;


interface ValidatorInterface
{
    public function isValid($value): bool;
}