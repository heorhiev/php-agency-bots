<?php
/**
 * Контроллер выхода
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Controllers\Http;

use App\Services\AuthorizationService;
use App\Services\ResponseService;


class LogoutController extends Controller
{
    public function main()
    {
        AuthorizationService::logout();
        ResponseService::redirect('/?page=entrance');
    }
}