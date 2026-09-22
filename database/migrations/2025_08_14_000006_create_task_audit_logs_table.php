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
        Schema::create('task_audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('workload_tasks')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('action'); // created, updated, deleted, status_changed, assigned, commented, etc.
            $table->string('field_name')->nullable(); // which field was changed
            $table->text('old_value')->nullable(); // previous value
            $table->text('new_value')->nullable(); // new value
            $table->text('description'); // human readable description of the change
            $table->json('metadata')->nullable(); // additional data like IP, user agent, etc.
            $table->timestamps();
            
            $table->index(['task_id', 'created_at']);
            $table->index(['user_id', 'created_at']);
            $table->index(['action', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_audit_logs');
    }
};
