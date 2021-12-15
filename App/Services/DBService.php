<?php
/**
 * Файл класса работы с БД
 *
 * @package App
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Services; 

use mysqli;
 

class DBService extends Service {
    
    private static $mysqli;


    /**
     * Возвращает объект mysqli после коннекта
     */
    public static function getMysqli() {
        if (!self::$mysqli) {
            self::$mysqli = new mysqli("localhost", DB_USER, DB_PASS, DB_NAME);;
        }

        return self::$mysqli;
    }
}