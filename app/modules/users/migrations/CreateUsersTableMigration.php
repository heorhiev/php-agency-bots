<?php

namespace app\modules\users\migrations;

use app\components\migrations\MigrationInterface;


class CreateUsersTableMigration implements MigrationInterface
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