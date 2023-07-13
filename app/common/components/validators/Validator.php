<?php

namespace app\common\components;

use app\common\components\validators\interfaces\ValidatorInterface;


abstract class Validator implements ValidatorInterface
{
    public function __construct(array $properties = [])
    {
        if (!$properties) {
            return;
        }

        foreach ($properties as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}