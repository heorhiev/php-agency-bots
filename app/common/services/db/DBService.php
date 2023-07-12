<?php

namespace app\common\services\db;

use app\common\dto\config\DatabaseDto;
use app\common\services\Service;
use app\common\services\SettingsService;
use mysqli;


class DBService extends Service
{
    private static $mysqli;


    public static function getMysqli(): mysqli
    {
        if (!self::$mysqli) {
            /** @var DatabaseDto $options */
            $options = SettingsService::load('database', DatabaseDto::class);
            self::$mysqli = new mysqli($options->host, $options->username, $options->password, $options->name);;
        }

        return self::$mysqli;
    }
}