<?php

namespace app;

use app\common\components\exceptions\NotFoundException;
use app\common\services\console\ArgvService;

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