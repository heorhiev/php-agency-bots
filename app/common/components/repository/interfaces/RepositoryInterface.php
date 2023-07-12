<?php

namespace app\common\components\repository\interfaces;

use app\common\components\Entity;
use app\common\components\repository\Repository;


interface RepositoryInterface
{
    public function findById(int $id): Repository;

    public function asArrayOne(): array;

    public function asEntityOne(): ?Entity;

    public function entityClassName(): string;

    public function save(Entity $entity): bool;

    public static function tableName(): string;
}