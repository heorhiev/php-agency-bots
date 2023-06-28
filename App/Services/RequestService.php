<?php
/**
 * Файл класса рендирования
 *
 * @package App
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Services; 
 

class RequestService extends Service
{
    /**
     * Возвращает данные http запроса метода POST
     */
    public static function get(string $name = null)
    {
        return ArrayService::getValue($_GET, $name, $_GET);
    }


    public static function post(string $name = null)
    {
        return ArrayService::getValue($_POST, $name, $_POST);
    }
}    