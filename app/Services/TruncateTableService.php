<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TruncateTableService
{
    public function truncateTable($tableName)
    {
        if (!Schema::hasTable($tableName)) {
            throw new \InvalidArgumentException("Table '$tableName' does not exist.");
        }

        Schema::disableForeignKeyConstraints();
        DB::table($tableName)->truncate();
        Schema::enableForeignKeyConstraints();
    }
}