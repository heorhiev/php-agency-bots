<?php

namespace app\services\http;
 

use app\services\Service;

class ResponseService extends Service
{
    public static function redirect(string $to, int $code = 307)
    {
        header("Location: " . $to, true, $code);
        exit;
    }


    public static function setHeader($header)
    {
        header($header);
    }
}    