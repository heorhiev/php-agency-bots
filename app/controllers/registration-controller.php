<?php
/**
 * Файл класса контроллера главной
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Controllers;

use Exception;
use App\Entities\UserEntity;
use App\Services\RequestService;
use App\Services\ValidatorService;
use App\Services\AuthorizationService;


class RegistrationController extends Controller {
    
    public function main() {

        if (RequestService::post('registration')) {
            // если отправлена форма регистрации
            try {
                $user = new UserEntity(
                    RequestService::post()
                );

                if (!ValidatorService::validateEmail($user->getEmail())) {
                    throw new Exception('Email не подходит.');
                }

                if (!ValidatorService::validatePassword($user->getPassword())) {                    
                    throw new Exception('Пароль не подходит.');
                }

                // регистрация и авторизация, если ок
                if ($user->execute()) {
                    AuthorizationService::auth($user);
                    $this->redirect('/');
                }
            } catch (Exception $e) {
                $message = $e->getMessage();
            }
        }

        $this->view('pages/registration', [
            'roles' => UserEntity::getRoles(),
            'message' => @$message,
        ]);
    }
}