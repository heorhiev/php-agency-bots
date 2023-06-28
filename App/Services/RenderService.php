<?php
/**
 * Файл класса рендирования
 *
 * @package App
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Services; 
 

class RenderService extends Service
{
    const PATH_TO_TEMPLATES = '../views/';
    

    /**
     * Отобразить шаблон 
     */
    public static function template(string $filename, array $attributes = []): string
    {
        if ($attributes) {
            extract($attributes);    
        }       

        include(APP_PATH_TO_TEMPLATES . $filename . '.php');

        return '';
    }  

    
    /**
     * Получить шаблон 
     */    
    public static function get(string $filename, array $attributes = [])
    {
        ob_start();
        
        self::template($filename, $attributes); 
        
        return ob_get_clean();   
    }
}    