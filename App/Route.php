<?php
/**
 * Файл класса роутинга
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */

namespace App;


use App\Exceptions\NotFoundException;

class Route
{
    /**
     * @throws NotFoundException
     */
    public static function run(?string $page)
    {
        if ($page) {
            $controllerClassName = implode([
                'App',
                'Controllers',
                $page . 'Controller'
            ], '\\');

            if (class_exists($controllerClassName)) {
                session_start();
                $controller = new $controllerClassName();
                $controller->main();

                return;
            }
        }

        throw new NotFoundException();
    }
}