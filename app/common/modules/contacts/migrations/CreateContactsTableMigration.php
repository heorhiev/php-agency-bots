<?php

namespace app\common\modules\contacts\migrations;

use app\common\components\migrations\MigrationInterface;


class CreateContactsTableMigration implements MigrationInterface
{
    public function up(): bool
    {
        return true;
    }


    public function down(): bool
    {
        return false;
    }
}