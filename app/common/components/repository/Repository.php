<?php

namespace app\common\components\repository;

use app\common\components\repository\interfaces\RepositoryInterface;
use app\common\components\repository\traits\FindTrait;
use app\common\components\repository\traits\SavedTrait;


abstract class Repository implements RepositoryInterface
{
    use FindTrait, SavedTrait;

    abstract public static function tableName(): string;

    abstract public static function entityClassName(): string;
}