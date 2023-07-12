<?php

namespace app\common\modules\contacts;

use app\common\components\Entity;
use app\common\modules\vacancy\repository\ContactsRepository;


class Contact extends Entity
{
    public $id;

    public $name;


    /**
     * Загрузка
     */
    protected function init($attributes = [])
    {
        $result = ContactsRepository::findById($attributes['id']);

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