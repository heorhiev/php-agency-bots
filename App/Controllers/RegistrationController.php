<?php
/**
 * Контроллер регистрации
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Controllers;

use Exception;
use App\Entities\UserEntity;
use App\Services\RequestService;
use App\Services\AuthorizationService;
use App\Repositories\UsersRepository;


class RegistrationController extends Controller
{
    public function main()
    {

        if (AuthorizationService::isAuthUser()) {
            $this->redirect('/');
        }

        if (RequestService::post('registration')) {
            try {
                $user = UsersRepository::addUser(
                    RequestService::post()
                );

                if ($user) {
                    AuthorizationService::auth($user);
                    $this->redirect('/');
                } else {
                    $message = 'Ошибка регистрации.';
                }
            } catch (Exception $e) {
                $message = $e->getMessage();
            }
        }

        $this->view('pages/registration', [
            'roles' => UserEntity::getRoles(),
            'message' => $message ?? '',
        ]);
    }
}