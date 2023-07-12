<?php

namespace app\common\components;


abstract class Entity
{

    const TABLE = '';

    protected $id;


    abstract public static function fields(): array;

    
    public function __construct($attributes = [])
    {
        $this->init($attributes);
    }


    public function getId()
    {
        return $this->id;
    }


    public static function getTableName(): string
    {
        return static::TABLE;
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