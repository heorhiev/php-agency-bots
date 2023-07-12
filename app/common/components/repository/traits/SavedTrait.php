<?php

namespace app\common\components\repository\traits;

use app\common\components\Entity;
use app\common\services\db\DBService;


/**
 * @method static string tableName()
 */
trait SavedTrait
{
    public static $types = ['integer' => 'i', 'string' => 's'];


    public static function save(Entity $entity): bool
    {
        $types = array_map([self::class, 'getBindTypeByType'], array_keys($entity::fields()));

        $columns = array_merge(...array_values($entity::fields()));
        $placeholders = [];

        foreach ($columns as $column) {
            $placeholders[] = '?';
            $values[] = $entity->{$column};
        }

        $columns = join(', ', $columns);
        $placeholders = join(', ', $placeholders);

        $st = DBService::getMysqli()->prepare(
            sprintf('INSERT INTO %s (%s) VALUES (%s)', static::tableName(), $columns, $placeholders)
        );

        $st->bind_param(join('', $types), ...$values);

        return $st->execute();
    }


    private static function getBindTypeByType($type): string
    {
        return self::$types[$type];
    }
}