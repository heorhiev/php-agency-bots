<?php
/**
 * Файл класса авторизации
 *
 * @package App
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Services; 

use App\Entities\UserEntity;
use App\Services\SessionService;;
 

class AuthorizationService extends Service {
    
    /**
     * Авторизация пользователя
     */
    public static function auth($user) {
        if ($user->getId()) {
            SessionService::set('user_id', $user->getId());
            return true;
        }

        return false;
    }


    /**
     * Возвращает авторизированного пользователя
     */
    public static function getAuthUser() {
        $userId = SessionService::get('user_id');

        if ($userId) {
            // если в сессии сохранен id пользователя, загружается нужный пользователь
            $user = new UserEntity([
                'id' => $userId,
            ]);

            if ($user->getId()) {
                return $user;
            }
        }

        return null;
    }
}