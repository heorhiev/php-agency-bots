<?php

namespace app\common\components\repository;

use app\common\components\repository\interfaces\RepositoryInterface;
use app\common\components\repository\traits\FindTrait;
use app\common\components\repository\traits\SavedTrait;


abstract class Repository implements RepositoryInterface
{
    use FindTrait, SavedTrait;

    protected $_entityClassName;


    abstract public static function tableName(): string;


    public function __construct($entityClassName)
    {
        $this->_entityClassName = $entityClassName;
    }


    public function entityClassName(): string
    {
        return $this->_entityClassName;
    }
}