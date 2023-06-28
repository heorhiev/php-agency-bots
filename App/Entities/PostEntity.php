<?php

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
}