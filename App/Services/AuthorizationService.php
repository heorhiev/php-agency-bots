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
 

class AuthorizationService extends Service
{
    public static function auth(UserEntity $user): bool
    {
        if ($user->getId()) {
            SessionService::set('user_id', $user->getId());
            return true;
        }

        return false;
    }


    public static function logout()
    {
        SessionService::set('user_id', null);
    }


    public static function isAuthUser(): bool
    {
        return (bool) self::getAuthUser();
    }


    public static function getAuthUser(): ?UserEntity
    {
        $userId = SessionService::get('user_id');

        if ($userId) {
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