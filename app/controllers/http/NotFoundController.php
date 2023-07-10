<?php

namespace app\controllers\http;

use app\controllers\Controller;
use app\services\http\ResponseService;


class NotFoundController extends Controller
{
    public function main()
    {
        ResponseService::setHeader('HTTP/1.0 404 Not Found');
    }
}