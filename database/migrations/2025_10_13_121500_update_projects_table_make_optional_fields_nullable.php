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
        Schema::table('projects', function (Blueprint $table) {
            $table->longText('description')->nullable()->change();
            $table->string('location')->nullable()->change();
            $table->decimal('price', 15, 2)->nullable()->change();
            $table->decimal('area', 10, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->longText('description')->nullable(false)->change();
            $table->string('location')->nullable(false)->change();
            $table->decimal('price', 15, 2)->nullable(false)->change();
            $table->decimal('area', 10, 2)->nullable(false)->change();
        });
    }
};