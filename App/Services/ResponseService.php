<?php
/**
 * Файл класса ответа
 *
 * @package App
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Services; 
 

class ResponseService extends Service
{
    /**
     * Редирект
     */
    public static function redirect(string $to, int $code = 307)
    {
        header("Location: " . $to, true, $code);
        exit;
    }


    public static function setHeader($header)
    {
        header($header);
    }
}    