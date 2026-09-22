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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('full_address');
            $table->string('city');
            $table->string('location')->nullable(); // Google map location
            $table->decimal('price', 15, 2);
            $table->foreignId('property_category_id')->constrained('property_categories');
            $table->enum('property_status', ['for_rent', 'for_sale']);
            $table->enum('size_prefix', ['Marla', 'Square Feet', 'Square Yards']);
            $table->decimal('size', 10, 2);
            $table->decimal('marla_value', 10, 2)->default(272); // 1 Marla = 272 sq ft
            $table->enum('furnished_status', ['Furnished', 'Non-Furnished']);
            $table->integer('rooms');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('garages')->default(0);
            $table->text('amenities')->nullable(); // JSON encoded amenities
            $table->string('video_url')->nullable();
            $table->string('primary_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_sold')->default(false);
            $table->boolean('is_deactivated')->default(false);
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
