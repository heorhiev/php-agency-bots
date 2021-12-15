<?php
/**
 * Файл класса роутинга
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */

namespace App;


class Route {

    public function __construct($page) {

        $controllerClassName = implode([
            'App',
            'Controllers',
            $page . 'Controller'
        ], '\\');

        if (class_exists($controllerClassName)) {
            session_start();
            $controller = new $controllerClassName();
            $controller->main();
        }
    }
}