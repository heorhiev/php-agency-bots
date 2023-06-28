<?php
/**
 * Файл класса сущности
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Entities;


abstract class Entity
{

    const TABLE = '';

    protected $id;

    
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
     * Загрузка
     */
    abstract protected function init($attributes = []);
}