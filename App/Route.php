<?php

namespace App;

use App\Exceptions\NotFoundException;


class Route
{
    /**
     * @throws NotFoundException
     */
    public static function run($side, ?string $page)
    {
        if ($page) {
            $controllerClassName = implode('\\', [
                'App',
                'Controllers',
                $side,
                $page . 'Controller'
            ]);

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