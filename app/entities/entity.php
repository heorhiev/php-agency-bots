<?php
/**
 * Файл класса сущности
 *
 * @package app
 * @author  Ruslan Heorhiiev
 * @version 1.0.0
 */
 
namespace App\Entities;


class Entity {

    const TABLE = '';

    protected $id;

    
    public function __construct($attributes = []) {
        $this->init($attributes);
    }


    public function getId() {
        return $this->id;
    }


    public function execute() {

    }


    public static function getTableName() {
        return static::TABLE;
    }


    protected function init($attributes) {

    }
}