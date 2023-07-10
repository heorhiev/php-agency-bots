<?php

namespace app\components\migrations;


interface MigrationInterface
{
    public function up(): bool;
    public function down(): bool;
}