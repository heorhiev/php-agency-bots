<?php

namespace app\services\http;
 

use app\services\ArrayService;
use app\services\Service;

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