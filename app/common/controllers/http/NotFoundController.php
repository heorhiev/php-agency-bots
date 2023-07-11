<?php

namespace app\common\controllers\http;

use app\common\controllers\Controller;
use app\common\services\http\ResponseService;


class NotFoundController extends Controller
{
    public function main()
    {
        ResponseService::setHeader('HTTP/1.0 404 Not Found');
    }
}