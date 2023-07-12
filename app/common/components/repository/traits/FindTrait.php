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
    private $result;


    public function findById(int $id): Repository
    {
        $st = DBService::getMysqli()->prepare('SELECT * FROM ' . static::tableName() . ' WHERE id = ?');

        $st->bind_param('i', $id);

        $st->execute();

        $result = $st->get_result();

        $this->result = $result->num_rows ? $result->fetch_array() : [];

        return $this;
    }


    public function asArrayOne(): array
    {
        return $this->result;
    }


    public function asEntityOne(): Entity
    {
        return new ($this->entityClassName())($this->result);
    }
}