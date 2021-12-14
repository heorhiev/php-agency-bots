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

class PostEntity extends Entity {

    const TABLE = 'posts';

    private $title;
    private $content;
    private $userRole;
    private $button;

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getUserRole() {
        return $this->userRole;
    }

    public function getButton() {
        return $this->button;
    }


    /**
     * Добавление записи
     */
    public function execute() {
        $st = DBService::getMysqli()->prepare(
            'INSERT INTO ' . static::TABLE . '(title, content, user_role, button) VALUES (?, ?, ?, ?)'
        );
        
        $st->bind_param(
            'ssss', 
            $this->title, $this->content, $this->userRole, $this->button
        );

        print_r($st);

        $st->execute();
    }


    /**
     * Загрузка
     */
    protected function init($attributes) {
        $this->title = $attributes['title'];
        $this->content = $attributes['content'];
        $this->userRole = $attributes['user_role'];
        $this->button = $attributes['button'];
    }
}