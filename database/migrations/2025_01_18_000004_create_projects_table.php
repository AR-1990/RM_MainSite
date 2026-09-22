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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description');
            $table->text('short_description')->nullable();
            $table->string('location');
            $table->decimal('price', 15, 2);
            $table->enum('price_type', ['per_sqft', 'total', 'negotiable'])->default('total');
            $table->decimal('area', 10, 2);
            $table->enum('area_unit', ['sqft', 'sqm', 'acres'])->default('sqft');
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('parking')->nullable();
            $table->enum('project_type', ['residential', 'commercial', 'mixed'])->default('residential');
            $table->enum('status', ['planning', 'under_construction', 'ready_to_move', 'completed'])->default('planning');
            $table->date('completion_date')->nullable();
            $table->string('developer')->nullable();
            $table->json('amenities')->nullable();
            $table->json('features')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->string('featured_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->json('floor_plans')->nullable();
            $table->string('brochure')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['is_active', 'is_featured']);
            $table->index(['project_type', 'status']);
            $table->index(['location']);
            $table->index(['price']);
            $table->index(['completion_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
