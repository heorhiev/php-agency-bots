<?php

namespace app;

use app\exceptions\NotFoundException;


class Route
{
    /**
     * @throws NotFoundException
     */
    public static function start($side, ?string $action)
    {
        if ($action) {
            $basePath = 'App\Controllers\\';

            $relativePath = explode('/', $action);

            $controllerName = ucfirst(array_pop($relativePath)) .  'Controller';

            $relativePath = join('\\', $relativePath);

            $controllerPath = $basePath . $side . '\\' . $relativePath . '\\' . $controllerName;

            if (class_exists($controllerPath)) {
                session_start();
                $controller = new $controllerPath();
                $controller->main();

                return;
            }
        }

        throw new NotFoundException();
    }
}