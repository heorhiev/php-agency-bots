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
use App\Services\SessionService;
use App\Services\AuthorizationService;


class EntranceController extends Controller {

    public function main() {

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
            'message' => isset($message) ? $message : '',
        ]);
    }
}