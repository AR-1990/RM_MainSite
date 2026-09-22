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
        Schema::create('workload_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->enum('frequency', ['daily', 'weekly', 'monthly', 'one_time'])->default('one_time');
            $table->date('start_date');
            $table->date('due_date');
            $table->time('reminder_time')->nullable();
            $table->boolean('is_recurring')->default(false);
            $table->integer('recurring_interval')->nullable(); // days, weeks, months
            $table->date('next_reminder_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workload_tasks');
    }
};
