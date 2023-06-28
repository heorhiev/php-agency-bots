<?php

namespace App;

use App\Exceptions\NotFoundException;
use App\Services\RequestService;

class Main
{
    /**
     * @throws NotFoundException
     */
    public function __construct()
    {
        $get = RequestService::get();

        try {
            Route::run($get['page'] ?? 'Home');
        } catch (NotFoundException $exception) {
            Route::run('NotFound');
        }
    }
}