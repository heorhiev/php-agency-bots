<?php

namespace app\common\modules\contacts;

use app\common\components\Entity;


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
}