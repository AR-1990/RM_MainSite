<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('salary_payment_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salary_payment_id')->constrained('salary_payments')->cascadeOnDelete();
            $table->string('action'); // created, updated, deleted
            $table->json('details')->nullable();
            $table->foreignId('changed_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salary_payment_logs');
    }
};


