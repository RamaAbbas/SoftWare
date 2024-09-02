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
        Schema::table('contacts_whats_next', function (Blueprint $table) {
            $table->integer('step_no')->nullable()->after('nl_step');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts_whats_next', function (Blueprint $table) {
            $table->dropColumn('step_no');
        });
    }
};
