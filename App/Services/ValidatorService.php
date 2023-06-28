<?php

namespace App\Services; 

 
class ValidatorService extends Service
{
    public static function validateEmail($email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // доп. проверка: мин 3 символа до @ и мин 3 буквы после @
            $parts = explode('@', $email);
            
            $len1 = mb_strlen($parts[0]);
            $len2 = mb_strlen(preg_replace("/[^a-zA-Z.]/", '', $parts[1]));

            if ($len1 > 2 && $len2 > 2) {
                return true;
            } 
        }

        return false;
    }


    public static function validatePassword($password): bool
    {
        if (mb_strlen($password) > 5 && strrpos($password, '!') !== false) {
            return true;
        }

        return false;
    }
}