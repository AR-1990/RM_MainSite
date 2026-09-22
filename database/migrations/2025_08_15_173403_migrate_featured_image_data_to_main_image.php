<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if featured_image column still exists and has data
        if (Schema::hasColumn('projects', 'featured_image')) {
            // Copy data from featured_image to main_image where main_image is null
            DB::statement("
                UPDATE projects 
                SET main_image = featured_image 
                WHERE main_image IS NULL 
                AND featured_image IS NOT NULL 
                AND featured_image != ''
            ");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // If we need to rollback, we can copy data back
        if (Schema::hasColumn('projects', 'featured_image')) {
            DB::statement("
                UPDATE projects 
                SET featured_image = main_image 
                WHERE featured_image IS NULL 
                AND main_image IS NOT NULL 
                AND main_image != ''
            ");
        }
    }
};
