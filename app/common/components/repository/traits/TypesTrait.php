<?php

namespace app\common\components\repository\traits;

use app\common\components\Entity;


/**
 * @method Entity entityClassName()
 */
trait TypesTrait
{
    public static $types = ['integer' => 'i', 'string' => 's'];


    public function getBindTypes(array $columns): array
    {
        $entityTypeColumns = [];

        foreach ($this->entityClassName()::fields() as $key => $values) {
            $entityTypeColumns += array_fill_keys($values, $key);
        }

        $typeColumns = [];

        foreach ($columns as $column) {
            $typeColumns[] = self::$types[$entityTypeColumns[$column]];
        }

        return $typeColumns;
    }
}