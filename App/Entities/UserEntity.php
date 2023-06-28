<?php

namespace App\Entities;

use App\Repositories\UsersRepository;


class UserEntity extends Entity
{

    const TABLE = 'users';

    private $email;
    private $role;
    private $password;

    // roles
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


    public function getEmail()
    {
        return $this->email;
    }


    public function getPassword()
    {
        return $this->password;
    }


    public function getRole()
    {
        return $this->role;
    }


    /**
     * Detect user leve by role
     */
    public function getLevel()
    {
        $role = $this->getRole();

        if (isset(self::$roles[$role])) {
            return self::$roles[$role]['level'];
        }

        return null;
    }


    /**
     * Check access by level
     */
    public function can($level): bool
    {
        return $this->getLevel() >= $level;
    }


    public static function getRoles(): array
    {
        return self::$roles;
    }


    /**
     * Load
     */
    protected function init($attributes = [])
    {
        $result = UsersRepository::getUser($attributes);

        if ($result) {
            $attributes = $result;
            $this->id = $attributes['id'];
        }

        parent::init($attributes);
    }
}