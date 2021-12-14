<?php
/**
 * Файл класса работы с сессиями
 *
 * @package App
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Services; 
 

class SessionService extends Service {
    
    /**
     * Запись в сессию
     */
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }


    /**
     * Получение из сессии
     */
    public static function get($key, $default = null) {
        
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return $default;
    }
}