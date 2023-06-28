<?php

namespace App\Controllers\Http;

use App\Entities\UserEntity;
use App\Repositories\UsersRepository;
use App\Services\AuthorizationService;
use App\Services\RequestService;
use Exception;


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