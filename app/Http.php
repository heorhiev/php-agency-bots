<?php

namespace app;

use app\common\components\exceptions\NotFoundException;
use app\common\services\http\RequestService;

class Http
{
    /**
     * @throws NotFoundException
     */
    public function __construct()
    {
        try {
            Route::start('http', RequestService::get('action'));
        } catch (NotFoundException $exception) {
            Route::start('http', 'NotFound');
        }
    }
}