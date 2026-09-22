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
        Schema::table('attendance_records', function (Blueprint $table) {
            $table->time('expected_check_in')->nullable()->after('check_in_time');
            $table->time('expected_check_out')->nullable()->after('check_out_time');
            $table->integer('late_minutes')->nullable()->after('break_hours');
            $table->boolean('is_late')->default(false)->after('late_minutes');
            $table->decimal('overtime_hours', 5, 2)->nullable()->after('late_minutes');
            $table->string('attendance_note')->nullable()->after('comments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_records', function (Blueprint $table) {
            $table->dropColumn([
                'expected_check_in',
                'expected_check_out', 
                'late_minutes',
                'is_late',
                'overtime_hours',
                'attendance_note'
            ]);
        });
    }
};
