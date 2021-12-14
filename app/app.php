<?php
/**
 * Файл класса роутинга
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */

class App {

    public function __construct($page) {

        $controllerClassName = implode([
            'App',
            'Controllers',
            $page . 'Controller'
        ], '\\');

        if (class_exists($controllerClassName)) {
            $controller = new $controllerClassName();
            $controller->main();
        }
    }
}