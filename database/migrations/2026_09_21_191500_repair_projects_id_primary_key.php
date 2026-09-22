<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $indexes = DB::select("SHOW INDEX FROM projects WHERE Key_name = 'PRIMARY'");

        if (empty($indexes)) {
            DB::statement('ALTER TABLE projects ADD PRIMARY KEY (`id`)');
        }

        DB::statement('ALTER TABLE projects MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');

        $nextId = ((int) DB::table('projects')->max('id')) + 1;
        DB::statement('ALTER TABLE projects AUTO_INCREMENT = ' . max($nextId, 1));
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE projects MODIFY `id` BIGINT UNSIGNED NOT NULL');
    }
};
