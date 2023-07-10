<?php

namespace app\controllers\http;

use app\services\http\ResponseService;


abstract class Controller
{
    abstract public function main();


    protected function redirect(string $to)
    {
        ResponseService::redirect($to);
    }
}