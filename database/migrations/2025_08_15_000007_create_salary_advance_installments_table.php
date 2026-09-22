<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('salary_advance_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salary_advance_id')->constrained('salary_advances')->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->date('pay_date');
            $table->string('method')->default('salary_deduction');
            $table->string('notes')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salary_advance_installments');
    }
};


