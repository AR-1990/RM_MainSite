<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('projects', 'project_category_id')) {
            return;
        }

        Schema::table('projects', function (Blueprint $table) {
            $table->dropConstrainedForeignId('project_category_id');
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn('projects', 'project_category_id')) {
            return;
        }

        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('project_category_id')->nullable()->after('floors')->constrained('project_categories')->nullOnDelete();
        });
    }
};
