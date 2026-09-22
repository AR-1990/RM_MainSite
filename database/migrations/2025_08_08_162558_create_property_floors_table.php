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
        Schema::create('property_floors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
            $table->string('floor_name');
            $table->decimal('floor_price', 15, 2);
            $table->string('price_prefix')->default('PKR');
            $table->decimal('floor_size', 10, 2);
            $table->string('size_postfix')->default('sq ft');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->string('floor_image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_floors');
    }
};
