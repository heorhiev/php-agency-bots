<?php

namespace app\services\db;

use app\dto\config\DatabaseDto;
use app\services\Service;
use app\services\SettingsService;
use mysqli;


class DBService extends Service
{
    private static $mysqli;


    public static function getMysqli(): mysqli
    {
        if (!self::$mysqli) {
            /** @var DatabaseDto $options */
            $options = new SettingsService('database', DatabaseDto::class);
            self::$mysqli = new mysqli($options->host, $options->username, $options->password, $options->name);;
        }

        return self::$mysqli;
    }
}