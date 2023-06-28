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


class LogoutController extends Controller
{
    public function main()
    {
        AuthorizationService::logout();
        ResponseService::redirect('/entrance.php');
    }
}