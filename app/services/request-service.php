<?php
/**
 * Файл класса рендирования
 *
 * @package App
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Services; 
 

class RequestService extends Service {


    /**
     * Возвращает данные http запроса метода POST
     */
    public static function post($name = '') {  

        if ($name) {
            if (isset($_POST[$name])) {
                return $_POST[$name];
            }
        } else {
            return $_POST;
        }
        
        return null;
    }
}    