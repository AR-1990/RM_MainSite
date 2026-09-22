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
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('check_in_time')->nullable();
            $table->time('check_out_time')->nullable();
            $table->time('break_start_time')->nullable();
            $table->time('break_end_time')->nullable();
            $table->enum('status', ['present', 'absent', 'late', 'half_day', 'outdoor', 'leave'])->default('present');
            $table->enum('work_type', ['office', 'outdoor', 'remote', 'meeting'])->default('office');
            $table->string('location')->nullable(); // For outdoor work
            $table->text('work_description')->nullable(); // What work was done
            $table->text('comments')->nullable(); // General comments
            $table->decimal('total_hours', 5, 2)->nullable(); // Total working hours
            $table->decimal('break_hours', 3, 2)->nullable()->default(0); // Break hours
            $table->boolean('is_approved')->default(false);
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            
            // Unique constraint for user and date
            $table->unique(['user_id', 'date']);
            
            // Indexes for better performance
            $table->index(['date', 'status']);
            $table->index(['user_id', 'date']);
            $table->index(['work_type', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_records');
    }
};
