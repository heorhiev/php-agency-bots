<?php
/**
 * Файл класса контроллера
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Controllers;

use App\Services\RenderService;
use App\Services\ResponseService;


abstract class Controller {        
    
    /**
     * Отображение шаблона
     */
    protected function view($template, $params = []) {
        return RenderService::template($template, $params);
    }


    /**
     * Редирект
     */
    protected function redirect($to) {
        return ResponseService::redirect($to);;
    }
}