<?php

namespace App\Controllers\Http;

use App\Entities\UserEntity;
use App\Services\AuthorizationService;
use App\Services\RequestService;


class EntranceController extends Controller
{
    public function main(): string
    {
        if (AuthorizationService::isAuthUser()) {
            $this->redirect('/');
        }
     
        if (RequestService::post('entrance')) {
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