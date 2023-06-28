<?php

namespace App\Services; 
 

class RequestService extends Service
{
    public static function get(string $name = null)
    {
        return ArrayService::getValue($_GET, $name, $_GET);
    }


    public static function post(string $name = null)
    {
        return ArrayService::getValue($_POST, $name, $_POST);
    }
}    