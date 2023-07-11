<?php

namespace app\common\services\console;

use app\common\services\Service;


class ArgvService extends Service
{
    public static function getCommand($argv): ?string
    {
        if (isset($argv[1])) {
            return $argv[1];
        }

        return null;
    }
}