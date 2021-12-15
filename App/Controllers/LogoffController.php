<?php
/**
 * Контроллер выхода
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Controllers;

use App\Services\ResponseService;
use App\Services\AuthorizationService;


class LogoffController extends Controller {
    
    public function main() {
        AuthorizationService::logoff();
        ResponseService::redirect('/entrance.php');
    }
}