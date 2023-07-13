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
    private $_result;


    public function findById(int $id): Repository
    {
        $stmt = DBService::getMysqli()->prepare('SELECT * FROM ' . static::tableName() . ' WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $this->_result = $result->num_rows ? $result->fetch_array() : [];

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
}