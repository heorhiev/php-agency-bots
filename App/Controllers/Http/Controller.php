<?php

namespace App\Controllers\Http;

use App\Services\RenderService;
use App\Services\ResponseService;


abstract class Controller
{
    abstract public function main();


    protected function view(string $template, array $params = []): string
    {
        return RenderService::template($template, $params);
    }


    protected function redirect(string $to)
    {
        ResponseService::redirect($to);
    }
}