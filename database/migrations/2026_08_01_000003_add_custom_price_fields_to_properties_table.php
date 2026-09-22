<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->boolean('use_custom_price_label')->default(false)->after('price');
            $table->string('custom_price_label', 120)->nullable()->after('use_custom_price_label');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['use_custom_price_label', 'custom_price_label']);
        });
    }
};
