<?php

namespace app;

use App\Exceptions\NotFoundException;
use app\services\console\ArgvService;

class Console
{
    /**
     * @throws NotFoundException
     */
    public function __construct($argv)
    {
        try {
            Route::start('console', ArgvService::getCommand($argv));
        } catch (NotFoundException $exception) {
            Route::start('console', 'NotFound');
        }
    }
}