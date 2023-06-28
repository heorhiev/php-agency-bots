<?php
/**
 * Контроллер страницы входа
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Controllers\Http;

use App\Entities\UserEntity;
use App\Services\AuthorizationService;
use App\Services\RequestService;


class EntranceController extends Controller
{
    public function main(): string
    {
        if (AuthorizationService::isAuthUser()) {
            // если пользователь авторизирован
            $this->redirect('/');
        }
     
        if (RequestService::post('entrance')) {
            // если отправлена форма, идет проверка и авторизация пользователя
            $user = new UserEntity(RequestService::post());
            
            if (AuthorizationService::auth($user)) {
                $this->redirect('/');
            } else {
                $message = 'Пользователь не найден.';
            }
        }

        return $this->view('pages/entrance', [
            'message' => $message ?? '',
        ]);
    }
}