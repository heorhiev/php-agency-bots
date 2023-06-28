<?php

namespace App\Controllers\Http;

use App\Services\ResponseService;


class NotFoundController extends Controller
{
    public function main(): string
    {
        ResponseService::setHeader('HTTP/1.0 404 Not Found');
        return $this->view('errors/404');
    }
}