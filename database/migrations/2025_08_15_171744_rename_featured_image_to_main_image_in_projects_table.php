<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Only rename if the source column exists
        if (Schema::hasColumn('projects', 'featured_image')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->renameColumn('featured_image', 'main_image');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Only rename back if the target column exists
        if (Schema::hasColumn('projects', 'main_image')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->renameColumn('main_image', 'featured_image');
            });
        }
    }
};
