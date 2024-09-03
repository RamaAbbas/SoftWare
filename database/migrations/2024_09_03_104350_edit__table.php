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
        Schema::table('steps_processs', function (Blueprint $table) {
            $table->integer('step_no')->nullable()->after('about_us_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('steps_processs', function (Blueprint $table) {
            $table->dropColumn('step_no');
        });
    }
};
