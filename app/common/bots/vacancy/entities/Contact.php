<?php

namespace app\common\bots\vacancy\entities;

use app\common\components\Entity;
use app\common\components\repository\Repository;
use app\common\bots\vacancy\repository\ContactsRepository;


class Contact extends Entity
{
    public $id;
    public $name;
    public $step;


    public static function fields(): array
    {
        return [
            'integer' => ['id', 'step'],
            'string' => ['name'],
        ];
    }


    public static function repository(): Repository
    {
        return new ContactsRepository(self::class);
    }
}