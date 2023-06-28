<?php

namespace App\Services;


class ArrayService extends Service
{
    public static function getValue($array, $key, $default = null)
    {
        if (isset($array[$key])) {
            return $array[$key];
        }

        return $default;
    }
}