<?php
/**
 * Файл класса сущности
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Entities;


class PostEntity extends Entity
{

    const TABLE = 'posts';

    private $title;
    private $content;
    private $userRole;
    private $button;

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getUserRole()
    {
        return $this->userRole;
    }

    public function getButton()
    {
        return $this->button;
    }


    /**
     * Загрузка
     */
    protected function init($attributes = [])
    {
        $this->title = $attributes['title'];
        $this->content = $attributes['content'];
        $this->userRole = $attributes['user_role'];
        $this->button = $attributes['button'];
    }
}