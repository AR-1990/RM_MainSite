<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixMigrationsTable extends Command
{
    protected $signature = 'migrations:fix-table';
    protected $description = 'Fix the migrations table by ensuring the id column is a PRIMARY KEY with AUTO_INCREMENT (MySQL)';

    public function handle(): int
    {
        $driver = config('database.default');

        try {
            if ($driver === 'mysql') {
                // Check if `id` column exists
                $idColumn = DB::select("SHOW COLUMNS FROM migrations LIKE 'id'");
                if (empty($idColumn)) {
                    // Add id column first if missing
                    DB::statement('ALTER TABLE migrations ADD COLUMN id INT UNSIGNED NOT NULL FIRST');
                    $this->info('Added id column to migrations table.');
                }

                // Check if PRIMARY KEY exists
                $primary = DB::select("SHOW KEYS FROM migrations WHERE Key_name = 'PRIMARY'");
                if (empty($primary)) {
                    DB::statement('ALTER TABLE migrations ADD PRIMARY KEY (id)');
                    $this->info('Added PRIMARY KEY(id) to migrations table.');
                }

                // Ensure AUTO_INCREMENT on id
                DB::statement('ALTER TABLE migrations MODIFY id INT UNSIGNED NOT NULL AUTO_INCREMENT');
                $this->info('Set id column to AUTO_INCREMENT.');

                $this->info('Migrations table fixed successfully.');
                return self::SUCCESS;
            }

            if ($driver === 'pgsql') {
                DB::statement('ALTER TABLE migrations ALTER COLUMN id SET NOT NULL');
                DB::statement('CREATE SEQUENCE IF NOT EXISTS migrations_id_seq OWNED BY migrations.id');
                DB::statement("ALTER TABLE migrations ALTER COLUMN id SET DEFAULT nextval('migrations_id_seq')");
                $this->info('Migrations table fixed for PostgreSQL: id column default sequence set.');
                return self::SUCCESS;
            }

            if ($driver === 'sqlite') {
                $this->warn('SQLite detected. No changes applied.');
                return self::SUCCESS;
            }

            $this->warn('Unsupported database driver: ' . $driver . '. No changes applied.');
            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error('Failed to fix migrations table: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}