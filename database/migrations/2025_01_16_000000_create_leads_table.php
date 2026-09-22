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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
            $table->string('company')->nullable();
            $table->enum('source', [
                'contact_form',
                'website',
                'referral',
                'social_media',
                'cold_call',
                'other'
            ])->default('contact_form');
            $table->enum('status', [
                'open',
                'new',
                'in_progress',
                'closed',
                'lost',
                'cancel'
            ])->default('new');
            $table->enum('priority', [
                'low',
                'medium',
                'high',
                'urgent'
            ])->default('medium');
            $table->decimal('value', 15, 2)->nullable();
            $table->string('currency', 3)->default('USD');
            $table->date('expected_close_date')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->text('notes')->nullable();
            $table->json('tags')->nullable();
            $table->json('attachments')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign keys
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            // Indexes
            $table->index(['status', 'priority']);
            $table->index('source');
            $table->index('assigned_to');
            $table->index('created_by');
            $table->index('expected_close_date');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
