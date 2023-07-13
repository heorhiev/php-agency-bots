<?php

namespace app\common\components\repository\traits;

use app\common\services\db\DBService;


/**
 * @method array getColumns()
 * @method array getBindTypes(array $columns)
 * @method static string tableName()
 */
trait SavedTrait
{
    public function create(array $attributes): bool
    {
        $columns = array_keys($attributes);
        $placeholders = join(', ', array_fill(0, count($attributes), '?'));
        $types = join('', $this->getBindTypes($columns));

        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)', static::tableName(),
            join(', ', $columns),
            $placeholders
        );

        $st = DBService::getMysqli()->prepare($sql);

        $st->bind_param($types, ...array_values($attributes));

        return $st->execute();
    }


    public function update(array $attributes, array $conditions): bool
    {
        $columns = [];

        // updated columns
        $updates = [];
        foreach ($attributes as $key => $value) {
            $columns[] = $key;
            $updates[] = $key . ' = ?';
        }
        $updates = join(', ', $updates);

        // conditions
        $where = [];
        foreach ($conditions as $key => $value) {
            $columns[] = $key;
            $where[] = $key . ' = ?';
        }
        $where = join(' AND ', $where);

        // bind types
        $types = join('', $this->getBindTypes($columns));

        // build sql
        $sql = sprintf('UPDATE %s SET %s WHERE %s', static::tableName(), $updates, $where);

        $st = DBService::getMysqli()->prepare($sql);

        $st->bind_param($types, ...array_merge(array_values($attributes), array_values($conditions)));

        return $st->execute();
    }
}