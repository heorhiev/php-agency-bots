<?php
/**
 * Файл инициализации
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */

define('APP_PATH', $_SERVER['DOCUMENT_ROOT'] . '/app/');
define('APP_PATH_TO_TEMPLATES', APP_PATH . 'views/');

define('DB_NAME', 'databasename');
define('DB_USER', 'ruslan');
define('DB_PASS', 'raqEyXD5_2!UoPF');

session_start();

include 'app.php';

// контроллеры
include 'controllers/controller.php';
include 'controllers/home-controller.php';
include 'controllers/entrance-controller.php';
include 'controllers/registration-controller.php';

// сущности
include 'entities/entity.php';
include 'entities/post-entity.php';
include 'entities/user-entity.php';

// услуги
include 'services/service.php';
include 'services/db-service.php';
include 'services/archive-service.php';
include 'services/render-service.php';
include 'services/session-service.php';
include 'services/request-service.php';
include 'services/response-service.php';
include 'services/validator-service.php';
include 'services/authorization-service.php';