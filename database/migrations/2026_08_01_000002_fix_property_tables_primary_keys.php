<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->fixPropertyCategoriesTable();
        $this->fixPropertiesTable();
        $this->fixPropertyImagesTable();
        $this->fixPropertyAmenitiesTable();
    }

    public function down(): void
    {
        // Keep this schema repair in place.
    }

    protected function fixPropertyCategoriesTable(): void
    {
        if (!Schema::hasTable('property_categories')) {
            return;
        }

        $this->ensurePrimaryKeyAndAutoIncrement('property_categories');
        $this->ensureIndex('property_categories', 'property_categories_name_index', 'name');
    }

    protected function fixPropertiesTable(): void
    {
        if (!Schema::hasTable('properties')) {
            return;
        }

        $this->ensurePrimaryKeyAndAutoIncrement('properties');
        $this->ensureIndex('properties', 'properties_user_id_index', 'user_id');
        $this->ensureIndex('properties', 'properties_property_category_id_index', 'property_category_id');
        $this->ensureIndex('properties', 'properties_is_active_index', 'is_active');
    }

    protected function fixPropertyImagesTable(): void
    {
        if (!Schema::hasTable('property_images')) {
            return;
        }

        $this->ensurePrimaryKeyAndAutoIncrement('property_images');
        $this->ensureIndex('property_images', 'property_images_property_id_index', 'property_id');
    }

    protected function fixPropertyAmenitiesTable(): void
    {
        if (!Schema::hasTable('property_amenities')) {
            return;
        }

        $this->ensurePrimaryKeyAndAutoIncrement('property_amenities');
        $this->ensureIndex('property_amenities', 'property_amenities_property_id_index', 'property_id');
    }

    protected function ensurePrimaryKeyAndAutoIncrement(string $table): void
    {
        if (!$this->hasIndex($table, 'PRIMARY')) {
            DB::statement("ALTER TABLE `{$table}` ADD PRIMARY KEY (`id`)");
        }

        DB::statement("ALTER TABLE `{$table}` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT");

        $nextId = ((int) DB::table($table)->max('id')) + 1;
        DB::statement("ALTER TABLE `{$table}` AUTO_INCREMENT = {$nextId}");
    }

    protected function ensureIndex(string $table, string $indexName, string $column): void
    {
        if ($this->hasIndex($table, $indexName)) {
            return;
        }

        DB::statement("ALTER TABLE `{$table}` ADD INDEX `{$indexName}` (`{$column}`)");
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
