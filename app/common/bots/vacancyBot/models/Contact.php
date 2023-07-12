<?php

namespace app\common\modules\contacts;

use app\common\components\Model;


class Contact extends Model
{
    const TABLE = 'users';

    public $id;

    public $email;

    public $name;


    /**
     * Загрузка
     */
    protected function init($attributes = [])
    {
        $result = UsersRepository::getUser($attributes);

        if ($result) {
            $attributes = $result;
            $this->id = $attributes['id'];
        }

        foreach ($attributes as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }
}