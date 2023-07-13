<?php

namespace app\common\components\repository\traits;

use app\common\components\Entity;
use app\common\components\repository\Repository;
use app\common\services\db\DBService;


/**
 * @method string entityClassName()
 * @method static string tableName()
 */
trait FindTrait
{
    private $_select = '*';

    private $_result;


    public function select(array $columns): Repository
    {
        $this->_select = join(', ', $columns);
        return $this;
    }


    public function findById(int $id): Repository
    {
        $stmt = DBService::getMysqli()->prepare(
            sprintf('SELECT %s FROM %s WHERE id = ?', $this->_select, static::tableName())
        );

        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $this->_result = $result->num_rows ? $result->fetch_assoc() : [];

        return $this;
    }


    public function filter($conditions): Repository
    {
        $where = $columns = [];
        foreach ($conditions as $key => $value) {
            $columns[] = $key;
            $where[] = $key . ' = ?';
        }
        $where = join(' AND ', $where);

        // bind types
        $types = join('', $this->getBindTypes($columns));

        $stmt = DBService::getMysqli()->prepare(
            sprintf('SELECT %s FROM %s WHERE %s', $this->_select, static::tableName(), $where)
        );

        $stmt->bind_param($types, ...array_values($conditions));
        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_row()) {
            $this->_result[] = $row;
        }

        return $this;
    }


    public function asArrayOne(): array
    {
        return $this->_result;
    }


    public function asEntityOne(): ?Entity
    {
        if ($this->_result) {
            $class = $this->entityClassName();
            return new $class($this->_result);
        }

        return null;
    }


    public function asArrayAll(): ?array
    {
        return $this->_result;
    }
}