<?php
/**
 * Файл класса сущности
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Entities;

use App\Repositories\UsersRepository;


class UserEntity extends Entity {

    const TABLE = 'users';

    private $email;
    private $role;
    private $password;

    // роли (должности)
    private static $roles = [
        'boss' => [
            'title' => 'Директор',
            'level' => 100,
        ],
        'manager' => [
            'title' => 'Менеджер',
            'level' => 50,
        ],
        'performer' => [
            'title' => 'Исполнитель',
            'level' => 1,
        ],
    ];


    public function getEmail() {
        return $this->email;
    }


    public function getPassword() {
        return $this->password;
    }


    public function getRole() {
        return $this->role;
    }


    /**
     * Определение уровня пользователя в зависимости от роли (должности)
     */
    public function getLevel() {
        $role = $this->getRole();

        if (isset(self::$roles[$role])) {
            return self::$roles[$role]['level'];
        }

        return;
    }


    /**
     * Право на действие в зависимости от уровня
     */
    public function can($level) {
        return $this->getLevel() >= $level;
    }


    public static function getRoles() {
        return self::$roles;
    }


    /**
     * Загрузка
     */
    protected function init($attributes = []) {

        $result = UsersRepository::getUser($attributes);

        if ($result) {
            $attributes = $result;
            $this->id = $attributes['id'];
        }

        if (isset($attributes['email'])) {
            $this->role = $attributes['email'];
        }

        if (isset($attributes['password'])) {
            $this->role = $attributes['password'];
        }

        if (isset($attributes['role'])) {
            $this->role = $attributes['role'];
        }
    }
}