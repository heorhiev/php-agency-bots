<?php

namespace App\Services; 
 

class RenderService extends Service
{
    const PATH_TO_TEMPLATES = '../views/';


    public static function template(string $filename, array $attributes = []): string
    {
        if ($attributes) {
            extract($attributes);    
        }       

        include(APP_PATH_TO_TEMPLATES . $filename . '.php');

        return '';
    }


    public static function get(string $filename, array $attributes = [])
    {
        ob_start();
        
        self::template($filename, $attributes); 
        
        return ob_get_clean();   
    }
}    