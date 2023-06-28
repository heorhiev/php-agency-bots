<?php
/**
 * Контроллер страницы входа
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */

namespace App\Controllers;

use App\Entities\UserEntity;
use App\Services\RequestService;
use App\Services\ResponseService;
use App\Services\SessionService;
use App\Services\AuthorizationService;


class NotFoundController extends Controller
{
    public function main(): string
    {
        ResponseService::setHeader('HTTP/1.0 404 Not Found');
        return $this->view('errors/404');
    }
}