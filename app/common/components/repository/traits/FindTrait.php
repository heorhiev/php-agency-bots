<?php

namespace app\common\components\repository\traits;

use app\common\components\Entity;
use app\common\services\db\DBService;


/**
 * @method static string tableName()
 * @method static string entityClassName()
 */
trait FindTrait
{
    private $result;


    public function findById(int $id): self
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
        return new (static::entityClassName())($this->result);
    }
}