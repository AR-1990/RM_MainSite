<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('salary_advances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('amount', 12, 2);
            $table->date('advance_date');
            $table->string('description')->nullable();
            $table->string('status')->default('pending'); // pending, settled
            $table->date('settled_on')->nullable();
            $table->string('settled_via')->nullable(); // salary_deduction, manual
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salary_advances');
    }
};


