<?php

namespace app;

use App\Exceptions\NotFoundException;
use app\services\http\RequestService;

class Http
{
    /**
     * @throws NotFoundException
     */
    public function __construct()
    {
        try {
            Route::start('Http', RequestService::get('action'));
        } catch (NotFoundException $exception) {
            Route::start('Http', 'NotFound');
        }
    }
}