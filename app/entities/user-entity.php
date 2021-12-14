<?php
/**
 * Файл класса сущности
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Entities;

use App\Services\DBService;


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
        if (isset(self::$roles[$this->getRole()])) {
            return self::$roles[$this->getRole()]['level'];
        }

        return;
    }


    /**
     * Право на действие в зависимости от уровня
     */
    public function can($level) {
        return $this->getLevel() >= $level;
    }


    /**
     * Добавление пользователя
     */
    public function execute() {
        if ($this->id) {
            return;
        }

        $st = DBService::getMysqli()->prepare(
            'INSERT INTO ' . static::TABLE . '(email, password, role) VALUES (?, ?, ?)'
        );
        
        $st->bind_param(
            'sss', 
            $this->email, $this->password, $this->role
        );

        if ($st->execute()) {
            $this->id = $st->insert_id;
            return true;
        }
    }


    public static function getRoles() {
        return self::$roles;
    }


    /**
     * Загрузка
     */
    protected function init($attributes) {
        $st = DBService::getMysqli()->prepare(
            'SELECT * FROM ' . static::TABLE . ' WHERE (email = ? AND password = ?) OR id = ?'
        );

        $st->bind_param(
            'ssi', 
            $attributes['email'], $attributes['password'], $attributes['id']
        );

        $st->execute();

        $result = $st->get_result();

        if ($result->num_rows) {
            // если что-то есть в БД, записываются данные из БД
            $attributes = $result->fetch_array();

            // только если найден пользователь
            $this->id = $attributes['id'];
        }

        $this->email = $attributes['email'];
        $this->password = $attributes['password'];

        if (isset($attributes['role'])) {
            $this->role = $attributes['role'];
        }
    }
}