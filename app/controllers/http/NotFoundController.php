<?php

namespace App\Controllers\Http;

use app\services\web\ResponseService;


class NotFoundController extends Controller
{
    public function main()
    {
        ResponseService::setHeader('HTTP/1.0 404 Not Found');
    }
}