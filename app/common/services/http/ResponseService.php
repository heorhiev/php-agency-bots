<?php

namespace app\common\services\http;
 

use app\common\services\Service;

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