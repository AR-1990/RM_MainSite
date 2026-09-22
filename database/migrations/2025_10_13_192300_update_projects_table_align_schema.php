<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'floors')) {
                $table->integer('floors')->nullable()->after('bathrooms');
            }
            if (!Schema::hasColumn('projects', 'main_image')) {
                $table->string('main_image')->nullable()->after('is_featured');
            }
            if (!Schema::hasColumn('projects', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('features');
            }
            if (!Schema::hasColumn('projects', 'video_url')) {
                $table->string('video_url')->nullable()->after('gallery_images');
            }
        });

        // Make selected columns nullable to allow creating projects with only title
        DB::statement("ALTER TABLE projects MODIFY description LONGTEXT NULL");
        DB::statement("ALTER TABLE projects MODIFY location VARCHAR(255) NULL");
        DB::statement("ALTER TABLE projects MODIFY price DECIMAL(15,2) NULL");
        DB::statement("ALTER TABLE projects MODIFY area DECIMAL(10,2) NULL");
    }

    public function down(): void
    {
        // Revert nullability changes
        DB::statement("ALTER TABLE projects MODIFY description LONGTEXT NOT NULL");
        DB::statement("ALTER TABLE projects MODIFY location VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE projects MODIFY price DECIMAL(15,2) NOT NULL");
        DB::statement("ALTER TABLE projects MODIFY area DECIMAL(10,2) NOT NULL");

        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'floors')) {
                $table->dropColumn('floors');
            }
            if (Schema::hasColumn('projects', 'main_image')) {
                $table->dropColumn('main_image');
            }
            if (Schema::hasColumn('projects', 'meta_title')) {
                $table->dropColumn('meta_title');
            }
            if (Schema::hasColumn('projects', 'video_url')) {
                $table->dropColumn('video_url');
            }
        });
    }
};