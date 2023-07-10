<?php

namespace app\services\db;

use app\services\Service;
use mysqli;


class DBService extends Service
{
    private static $mysqli;


    public static function getMysqli()
    {
        if (!self::$mysqli) {
            self::$mysqli = new mysqli("localhost", DB_USER, DB_PASS, DB_NAME);;
        }

        return self::$mysqli;
    }
}