<?php

namespace app\common\components\repository\interfaces;

use app\common\components\Entity;


interface RepositoryInterface
{
    public function findById(int $id): self;

    public function asArrayOne(): array;

    public function asEntityOne(): Entity;

    public static function tableName(): string;

    public static function entityClassName(): string;

    public static function save(Entity $entity): bool;
}