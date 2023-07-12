<?php

namespace app\common\components;

use app\common\components\repository\Repository;


abstract class Entity
{
    abstract public static function fields(): array;

    abstract public static function repository(): Repository;

    
    public function __construct($attributes = [])
    {
        $this->init($attributes);
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