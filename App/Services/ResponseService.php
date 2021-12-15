<?php
/**
 * Файл класса ответа
 *
 * @package App
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Services; 
 

class ResponseService extends Service {

    /**
     * Редирект
     */
    public static function redirect($to = '') {  
        header("Location: " . $to, true, 307);
        exit;
    }
}    