<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->enum('lead_status', ['new', 'open', 'in_progress', 'closed', 'lost', 'cancel'])->default('new')->after('status');
            $table->decimal('lead_value', 15, 2)->nullable()->after('lead_status');
            $table->string('lead_currency', 3)->default('USD')->after('lead_value');
            $table->date('expected_close_date')->nullable()->after('lead_currency');
            $table->json('lead_tags')->nullable()->after('expected_close_date');
            $table->text('lead_notes')->nullable()->after('lead_tags');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->after('lead_notes');
            $table->foreignId('created_by')->nullable()->constrained('users')->after('assigned_to');
            $table->timestamp('lead_created_at')->nullable()->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['assigned_to', 'created_by']);
            $table->dropColumn([
                'lead_status', 'lead_value', 'lead_currency', 'expected_close_date',
                'lead_tags', 'lead_notes', 'assigned_to', 'created_by', 'lead_created_at'
            ]);
        });
    }
};
