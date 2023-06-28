<?php

namespace App;

use App\Exceptions\NotFoundException;
use App\Services\RequestService;

class Http
{
    /**
     * @throws NotFoundException
     */
    public function __construct()
    {
        $get = RequestService::get();

        try {
            Route::run('Http', $get['page'] ?? 'Home');
        } catch (NotFoundException $exception) {
            Route::run('Http', 'NotFound');
        }
    }
}