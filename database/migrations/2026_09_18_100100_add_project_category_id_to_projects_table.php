<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('project_category_id')->nullable()->after('floors')->constrained('project_categories')->nullOnDelete();
        });

        DB::statement("
            UPDATE projects
            INNER JOIN project_categories
                ON project_categories.slug = REPLACE(LOWER(projects.project_type), ' ', '-')
            SET projects.project_category_id = project_categories.id
            WHERE projects.project_type IS NOT NULL
              AND projects.project_type <> ''
        ");
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropConstrainedForeignId('project_category_id');
        });
    }
};
