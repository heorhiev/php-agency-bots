<?php
/**
 * Файл класса репозитория пользователей
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Repositories;

use Exception;
use App\Entities\UserEntity;
use App\Services\DBService;
use App\Services\ValidatorService;


class UsersRepository extends Repository
{


    /**
     * Возвращает пользователя
     */
    public static function getUser($params = [])
    {
        $st = DBService::getMysqli()->prepare(
            'SELECT * FROM ' . UserEntity::getTableName() . ' WHERE (email = ? AND password = ?) OR id = ?'
        );

        $password = '';
        
        if (isset($params['password'])) {
            $password = self::passHash($params['password']);
        } 

        $st->bind_param(
            'ssi', 
            $params['email'], $password, $params['id']
        );

        $st->execute();

        $result = $st->get_result();

        if ($result->num_rows) {
            return $result->fetch_array();
        }

        return null;
    }


    /**
     * Добавление пользователя
     */
    public static function addUser($params)
    {

        if (!ValidatorService::validateEmail($params['email'])) {
            throw new Exception('Email не подходит.');
        }

        if (!ValidatorService::validatePassword($params['password'])) {                    
            throw new Exception('Пароль не подходит.');
        }

        $st = DBService::getMysqli()->prepare(
            'INSERT INTO ' . UserEntity::getTableName() . '(email, password, role) VALUES (?, ?, ?)'
        );
        
        $st->bind_param(
            'sss', 
            $params['email'], self::passHash($params['password']), $params['role']
        );

        if ($st->execute()) {
            return new UserEntity([
                'id' => $st->insert_id,
            ]);
        }
    }


    /**
     * Хеширование пароля
     * самый простой вариант
     */
    protected static function passHash($password): string
    {
        return md5($password);
    }
}