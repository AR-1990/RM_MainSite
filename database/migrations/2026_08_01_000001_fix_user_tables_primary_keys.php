<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->fixUsersTable();
        $this->fixUserProfilesTable();
    }

    public function down(): void
    {
        // Keep this schema repair in place.
    }

    protected function fixUsersTable(): void
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        if (!$this->hasPrimaryKey('users')) {
            DB::statement('ALTER TABLE `users` ADD PRIMARY KEY (`id`)');
        }

        DB::statement('ALTER TABLE `users` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');

        if (!$this->hasIndex('users', 'users_email_unique')) {
            DB::statement('ALTER TABLE `users` ADD UNIQUE `users_email_unique` (`email`)');
        }

        $nextId = ((int) DB::table('users')->max('id')) + 1;
        DB::statement("ALTER TABLE `users` AUTO_INCREMENT = {$nextId}");
    }

    protected function fixUserProfilesTable(): void
    {
        if (!Schema::hasTable('user_profiles')) {
            return;
        }

        if (!$this->hasPrimaryKey('user_profiles')) {
            DB::statement('ALTER TABLE `user_profiles` ADD PRIMARY KEY (`id`)');
        }

        DB::statement('ALTER TABLE `user_profiles` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');

        if (!$this->hasIndex('user_profiles', 'user_profiles_user_id_unique')) {
            DB::statement('ALTER TABLE `user_profiles` ADD UNIQUE `user_profiles_user_id_unique` (`user_id`)');
        }

        if (!$this->hasIndex('user_profiles', 'user_profiles_employee_id_unique')) {
            DB::statement('ALTER TABLE `user_profiles` ADD UNIQUE `user_profiles_employee_id_unique` (`employee_id`)');
        }

        $nextId = ((int) DB::table('user_profiles')->max('id')) + 1;
        DB::statement("ALTER TABLE `user_profiles` AUTO_INCREMENT = {$nextId}");
    }

    protected function hasPrimaryKey(string $table): bool
    {
        return $this->hasIndex($table, 'PRIMARY');
    }

    protected function hasIndex(string $table, string $indexName): bool
    {
        $database = DB::getDatabaseName();

        return DB::table('information_schema.statistics')
            ->where('table_schema', $database)
            ->where('table_name', $table)
            ->where('index_name', $indexName)
            ->exists();
    }
};
