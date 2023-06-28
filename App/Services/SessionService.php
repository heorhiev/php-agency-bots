<?php

namespace App\Services; 
 

class SessionService extends Service
{
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }


    public static function get($key, $default = null)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return $default;
    }
}