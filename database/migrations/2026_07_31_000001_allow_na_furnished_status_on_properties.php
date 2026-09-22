<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE properties MODIFY furnished_status ENUM('Furnished', 'Non-Furnished', 'N/A') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("UPDATE properties SET furnished_status = 'Non-Furnished' WHERE furnished_status = 'N/A'");
        DB::statement("ALTER TABLE properties MODIFY furnished_status ENUM('Furnished', 'Non-Furnished') NOT NULL");
    }
};
