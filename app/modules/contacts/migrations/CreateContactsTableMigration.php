<?php

namespace app\modules\contacts\migrations;

use app\components\migrations\MigrationInterface;


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