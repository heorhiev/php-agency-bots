<?php

namespace app\common\components;

use app\common\components\repository\Repository;


abstract class Entity
{
    public $id;


    abstract public static function fields(): array;

    abstract public static function repository(): Repository;

    
    public function __construct($attributes = [])
    {
        $this->init($attributes);
    }


    public function update(array $attributes): bool
    {
        return static::repository()->update($attributes, ['id' => $this->id]);
    }


    /**
     * Load
     */
    protected function init(array $attributes)
    {
        foreach ($attributes as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }
}